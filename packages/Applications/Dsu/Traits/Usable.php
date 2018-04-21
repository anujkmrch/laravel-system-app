<?php
namespace Dsu\Traits;

use Dsu\Models\CourseApplication;

trait Usable
{

	public function course($course)
	{
		$this->course = $course;
		return $this;
	}

	public function Applicable()
	{
		return true;
	}

	public function Apply()
	{
		return $this->hasMany(CourseApplication::class);
	}

	/**
	 * Mainly to apply number limits
	 * @return [type] [description]
	 */
	public function AppliedinSessions()
	{	
		$query = "SELECT ca.* FROM course_applications AS ca JOIN courses AS c on ca.course_id = c.id WHERE c.course_session_id={$this->course->session->id} AND ca.user_id={$this->getKey()}";

		$query = "SELECT ca.* FROM course_applications AS ca JOIN courses as c ON ca.course_id=c.id WHERE c.course_session_id={$this->course->session->id}";

		return count(\DB::select($query));	
	}

	public function hasApplied()
	{
		$query = "SELECT ca.* FROM course_applications AS ca JOIN courses AS c on c.id = ca.course_id JOIN course_sessions AS cs ON cs.id = c.course_session_id WHERE cs.active=1 AND ca.user_id={$this->getKey()} AND ca.course_id={$this->course->id}";
	
		$result = \DB::select($query);
    
        return count($result) != 0;
	}
	
}
?>