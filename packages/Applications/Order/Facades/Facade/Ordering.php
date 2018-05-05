<?php
namespace Order\Facades\Facade;

use Auth,DB;

class Ordering
{

	private $types = [];

	/**
	 * It return the System User model
	 * @return Object or null System\Models\User
	 */
	public function addType($key,$value =null)
	{
		if(!array_key_exists($key, $this->types)):
			$this->types[$key] = $value;
		endif;
	}

	public function getType($key, $default=null){
		if ($key and array_key_exists($key, $this->types)):
			return $this->types[$key];
		endif;
		return $default;
	}
	
}