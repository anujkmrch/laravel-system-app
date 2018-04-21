<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class SlugTrack extends Model
{
    protected $fillable = ['slug','ipaddress','is_guest'];
}