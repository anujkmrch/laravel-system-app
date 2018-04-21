<?php

namespace Order\Subscribers\Client;

class Client {

	public function subscribe($events)
	{
		$events->listen('order.client.order.onOrderSuccess',"\Order\Subscribers\Client\Subscribers\Order@onOrderSuccess");

		$events->listen('order.client.order.onOrderFailure',"\Order\Subscribers\Client\Subscribers\Order@onOrderFailure");

		$events->listen('order.client.order.onOrderStatusChange',"\Order\Subscribers\Client\Subscribers\Order@onOrderStatusChange");

		$events->listen('order.client.order.onOrderMappedSuccessfully',"\Order\Subscribers\Client\Subscribers\Order@onOrderMappedSuccessfully");
	}
}
?>