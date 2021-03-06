<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'recipient_name',
        'line1',
        'line2',
        'city',
        'postal_code',
        'state',
        'email',
        'total',
        'guide_number',
        'shopping_cart_id'
    ];
    public function address(){
        return "$this->line1 $this->line2";
    }
    public static function createFromPayPalResault($result, $shopping_cart){
        // hashear response

        $payer = $result->payer;

        $orderData = (array) $payer->payer_info->shipping_address;

        $orderData = $orderData[key($orderData)];   // convertir el objeto a arreglo
        $orderData["email"] = $payer->payer_info->email;
        $orderData["total"] = $shopping_cart->totalUSD();
        $orderData["shopping_cart_id"] = $shopping_cart->id;

        // crear el objeto de la orden, create puede recibir un hash de datos :  usar MASS ASIGNMENT
        return Order::create($orderData);
    }
}