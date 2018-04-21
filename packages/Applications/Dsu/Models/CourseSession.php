<?php

namespace Dsu\Models;

use Illuminate\Database\Eloquent\Model;
use Dsu\Traits\Sessionable;
class CourseSession extends Model
{
	use Sessionable;

	public $fillable = [
						'title',
						'application_starts_on',
						'applications_ends_on',
						'starts_from',
						'ends_on'
					];

	protected $dates = [
		'created_at',
		'applications_ends_on',
		'application_starts_on',
		'starts_from',
		'ends_on'
	];

	public function courses()
	{
		return $this->hasMany(Course::class);
	}

	public function getApplicationStartsOnAttribute($value)
	{
		return ($value);
	}

	public function getApplicationEndsOnAttribute($value)
	{
		return ($value);
	}

	public function getStartsFromAttribute($value)
	{
		return ($value);
	}

	public function getEndsOnAttribute($value)
	{
		return ($value);
	}
}