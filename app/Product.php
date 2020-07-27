<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Item;

class Product extends Model
{
    //
    public function paypalItem(){
        $item = new Item();
        $item->setName($this->title);
        $item->setDescription($this->description);
        $item->setCurrency('USD');
        $item->setQuantity(1);
        $item->setPrice($this->pricing / 850);

        return $item;
    }
}
