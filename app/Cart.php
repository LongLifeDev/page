<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($existingCart){
        if ($existingCart) {
            $this->items = $existingCart->items;
            $this->totalQuantity = $existingCart->totalQuantity;
            $this->totalPrice = $existingCart->totalPrice;
        }
    }

    public function add($item, $id) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice += $item->price;
    }

    public function remove($id) {
        if($this->items[$id]['qty'] <= 1){
            $this->items[$id]['qty']--;
            $this->items[$id]['price'] = 0;
            $this->totalQuantity--;
            $this->totalPrice -= $this->items[$id]['item']['price'];
            unset($this->items[$id]);
        } else {
            $this->items[$id]['qty']--;
            $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
            $this->totalQuantity--;
            $this->totalPrice -= $this->items[$id]['item']['price'];
        }
    }
}
