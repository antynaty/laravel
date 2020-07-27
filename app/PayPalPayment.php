<?php
namespace App;

use Illuminate\Support\Facades\Config;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;

class PayPalPayment
{
    private $apiContext;
    private $shopping_cart;

    // inicializar la conexion con paypal
    public function __construct($shopping_cart) 
    { 
        $paypalConfig = Config::get('paypal');

        // crear api context 
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );
        $this->shopping_cart=$shopping_cart;
    }
    public function generate()
    {
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($this->payer())
            ->setTransactions([$this->transaction()])
            ->setRedirectUrls($this->redirectUrls());

        // Make a Create Call 
        try {
            $payment->create($this->apiContext);
            echo $payment;
        } catch ( PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            dd($ex->getData());
            exit(1);
            // en produccion crear redirect al user e informar de un problema
        }
        return $payment;
    }
    public function execute($paymentId,$payerId){ 
        if(!$payerId || !$paymentId){
            $status = 'no se pudo realizar el pago en PayPal';
            return redirect( url('/carrito'))->with(compact('status'));
        }
        // if not if  generar el pago
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext); 
        return $result;
        // dd($result);   // acceder al state del result 
        
    }
    public function payer(){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        return $payer;
    }

    public function transaction(){
        $transaction = new Transaction();
        $transaction->setAmount($this->amount());
        $transaction->setItemList($this->items());
        $transaction->setDescription('Tu compra en Shopfy');
        $transaction->setInvoiceNumber(uniqid());
        return $transaction;
    }
    public function items(){
        $items = [];
        $products = $this->shopping_cart->products()->get();

        foreach( $products as $product){
            array_push($items,$product->paypalItem());
        }
        $itemList = new ItemList();
        $itemList->setItems($items);
        return $itemList;
    }
    public function amount(){
        $amount = new Amount();
        $amount->setTotal($this->shopping_cart->totalUSD());
        $amount->setCurrency('USD');

        return $amount;
    }

    public function redirectUrls(){
        $callbackUrl = url('/carrito');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$callbackUrl/paypal/pay")
            ->setCancelUrl(url($callbackUrl));
        
        return $redirectUrls;
    }
}
