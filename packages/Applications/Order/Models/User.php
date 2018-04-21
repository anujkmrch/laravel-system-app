<?php

namespace Order\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    public function Orders()
    {
        return $this->hasMany(Order::class);
    }
}