<?php

namespace Dsu\Models;

use Illuminate\Database\Eloquent\Model;
use Dsu\Traits\Usable;
use Dsu\Traits\Coursify;
use System\Models\User as SystemUser;
class User extends SystemUser
{
	use Usable, Coursify;

	public function setUser()
	{
		$user = $this;
		return $this;
	}

	public function userDocuments()
    {
        if(is_null($this->user_documents))
        {
            $this->user_documents = $this->documents->pluck('slug')->toArray();
        }
        return $this;
 
    }

	public function Documents()
    {
    	return $this->belongsToMany(Document::class)->withPivot('path');
    }

    public function Applications()
    {
    	return $this->hasMany(CourseApplication::class);
    }
}