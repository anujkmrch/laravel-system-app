<?php
namespace System\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use System\Facades\Facade\Client;

class ClientFacade extends Facade{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { 
    	return 'Client'; 
	}
}
?>