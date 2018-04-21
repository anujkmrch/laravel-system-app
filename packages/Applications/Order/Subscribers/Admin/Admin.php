<?php

namespace Order\Subscribers\Admin;

class Admin {
	public function subscribe($events)
	{
		$events->listen('order.admin.onCreateNewUser',"\System\Subscribers\Admin\Subscribers\User@onCreatingNewUser");

		$events->listen('order.admin.onDeleteUser',"\System\Subscribers\Admin\Subscribers\User@onDeleteUser");

		$events->listen('order.admin.onCreateNewRole',"\System\Subscribers\Admin\Subscribers\Role@onNewRole");
	}
}
?>