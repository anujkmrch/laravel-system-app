<?php
namespace Order\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Order\Facades\Facade\Ordering;

class OrderingFacade extends Facade{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor() { 
    	return 'Ordering'; 
	}
}
?>