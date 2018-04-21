<?php
/**
 * 
 * order.client.application.index represent
 * packageName.AppSpace.Controller.Method
 * 
 */

Route::group(['namespace'=>"\Order\Apps\Client\Controllers"],function(){
	Route::get('/orders',[
		'uses' => "OrderController@index",
		'as' => 'order.client.order.index'
	]);
});
?>