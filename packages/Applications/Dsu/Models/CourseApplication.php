<?php

namespace Dsu\Models;

use Illuminate\Database\Eloquent\Model;

use Dsu\Traits\Applicable;
use Order\Models\Order;
class CourseApplication extends Model
{
    use Applicable;

    protected $fillable = ['course_id','user_id','options','order_id'];

    public function Course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function User()
    {
    	return $this->belongsTo(User::class);
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getOptionsAttribute($value)
    {
        if(is_null($value))
            return [];

        if(is_string($value) and !is_array($value))
        {
            $value = json_decode($value,true);
        }

        return $value;
    }

    public function setOptionsAttribute($value)
    {
        // if(is_null($value))
        //     $value = [];

        if(is_array($value) or is_object($value))
            $value = json_encode($value);
        
        $this->attributes['options'] = $value;
    }

    /**
     * Get the option value
     * @param  [type] $option  [description]
     * @param  [type] $default [description]
     * @return [type]          [description]
     */
    public function getOption($option,$default = null)
    {
        if(is_array($options) and array_key_exists($option,$this->options))
        {
            return $this->options[$option];
        }
        return $default;
    }
    

    public function setOption($option,$value)
    {
        if(is_null($value)){
            unset($this->options[$option]);
            return;
        }

        $this->options[$option] = $value;
        return;
    }
}