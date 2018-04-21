<?php

namespace Dsu\Subscribers\Client;

class Client {

	public function subscribe($events)
	{
		$events->listen('dsu.client.course.onAppliedSuccessfully',"\Dsu\Subscribers\Client\Subscribers\Apply@onAppliedsuccessfully");

		$events->listen('dsu.client.course.onAppliedFailure',"\Dsu\Subscribers\Client\Subscribers\Apply@onAppliedFailure");

		$events->listen('dsu.client.course.onLimitOver',"\Dsu\Subscribers\Client\Subscribers\Apply@onlimitOver");
	}
}
?>