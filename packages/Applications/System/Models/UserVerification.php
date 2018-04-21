<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $fillable = ['code','expired_on'];
}
