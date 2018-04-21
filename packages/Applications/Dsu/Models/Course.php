<?php

namespace Dsu\Models;

use Illuminate\Database\Eloquent\Model;

use Dsu\Traits\Coursable;
use Dsu\Traits\Coursify;

class Course extends Model
{
    use Coursable,Coursify;

    public function Session()
    {
    	return $this->belongsTo(CourseSession::class,'course_session_id');
    }

    public function Documents(){
        return $this->belongsToMany(Document::class);
    }

    public function Applications()
    {
    	return $this->hasMany(CourseApplication::class);
    }
}
