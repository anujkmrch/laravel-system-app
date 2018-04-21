<?php
namespace Order\Models;
class Cart
{
    public $items = [];
    public $totalQty = 0;
    public $totalPrice = 0;

    public function  __construct($oldCart = null)
    {
        if($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    
    public function add($item, $qty=1)
    {
        $storedItem = ['qty'=>0,'price' => $qty*$item->price, 'item'=>$item];
        if($this->items and array_key_exists($item->id,$this->items))
        {
            $storedItem = $this->items[$item->id];
        }

        $storedItem['qty']= $storedItem['qty']+$qty;
        $storedItem['price']=$item->price*$storedItem['qty'];
        
        $this->totalQty+= $qty;

        $this->totalPrice += $qty*$item->price;

        $this->items[$item->id] = $storedItem;
    }
}