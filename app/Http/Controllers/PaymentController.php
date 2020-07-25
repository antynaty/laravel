<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;
    // inicializar la conexion con paypal
    public function __construct()
    { 
        $paypalConfig = Config::get('paypal');

        // crear api context 
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );
    }
    public function payWithPayPal()
    {
        // objeto pagador
            // $payer = new Payer();
            // $payer->setPaymentMethod('paypal');

        // objeto monto
            // $amount = new Amount();
            // $amount->setTotal('1.00');
            // $amount->setCurrency('USD');
        //objeto transaccion asignandole el monto 
            // $transaction = new Transaction();
            // $transaction->setAmount($amount);

        // url de redireccionamiento
            // $callbackUrl = url('/paypaly/status');
            // $redirectUrls = new RedirectUrls();
            // $redirectUrls->setReturnUrl(url('/paypal/status'))
            //     ->setCancelUrl(url('/paypal/status'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($this->payer())
            ->setTransactions([$this->transaction()])
            ->setRedirectUrls($this->setRedirectUrls());

        // Make a Create Call 
        try {
            $payment->create($this->apiContext);
            echo $payment;

            // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
            return redirect()->away($payment->getApprovalLink());
        } catch ( PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
            // en produccion crear redirect al user e informar de un problema
        }
    }

    public function payPalStatus(Request $request){
        // dd($request->all());
        $paymentId = $request->input('paymentId');
        $token = $request->input('token');
        $payerId = $request->input('PayerID');

        if(!$payerId || !$token || !$paymentId){
            $status = 'no se pudo realizar el pago en PayPal';
            return redirect( url('/carrito'))->with(compact('status'));
        }

        // if not if  generar el pago
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);
        // dd($result);   // acceder al state del result 

        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            return redirect('/carrito')->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/carrito')->with(compact('status'));
    }
    public function payer(){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        return $payer;
    }

    public function transaction(){
        $transaction = new Transaction();
        $transaction->setAmount($this->amount());
        // $transaction->setItemList($this->items());

        return $transaction;
    }

    public function amount(){
        $amount = new Amount();
        $amount->setTotal('3.99');// $amount->setTotal('$this->shopping_cart->totalUSD()');
        $amount->setCurrency('USD');

        return $amount;
    }

    public function setRedirectUrls(){
        $callbackUrl = url('/paypal/status');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url($callbackUrl))
            ->setCancelUrl(url($callbackUrl));
        
        return $redirectUrls;
    }
}
