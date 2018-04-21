<?php

namespace Order\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = [
        'created_at', 'updated_at'
    ];
    /**
     * Boot function for using with User Events.
     *
     * @todo Move events to an Observer.
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event('order.client.order.onOrderSuccess',$model);
        });

        static::saved(function ($model) {
            if ($model->getOriginal('status') !== $model->status) {
               event('order.client.order.onStatusChange',$model);
            }
        });
    }

    public function getCartAttribute($value)
    {
        if(is_string($value))
        {
            $this->attributes['cart']= $value = unserialize($value);
        }
        return $value;
    }

    public function setCartAttribute($value)
    {
        if(!is_string($value))
        {
            $this->attributes['cart']= $value = serialize($value);
        }
        // return $value;
    }

    public function getAmountDue()
    {
        return $this->cart->totalPrice - $this->paid;
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getAddressAttribute($value)
    {
        return "<br />".strtolower($value)." making changes here and make it possible";
    }

    public function isMyOrder()
    {
        return $this->user_id == \Auth::user()->id;
    }

    public function canCancel()
    {
        if($this->status!== 'completed')
        {
            return true;
        }
        return false;
    }

    public function isPaid()
    {
        if($this->status !== 'pending')
        {
            return true;
        }
        return false;   
    }

    public function isRefunded()
    {
        if($this->status !== 'refunded')
        {
            return true;
        }
        return false;   
    }
}
