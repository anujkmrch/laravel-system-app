<?php
Route::group(['prefix'=>'admin','namespace'=>"Order\Apps\Admin\Controllers"],function(){

	Route::name('order.admin.')->group(function () {
    	Route::resource('orders', 'OrderController');
    });
});
?>
