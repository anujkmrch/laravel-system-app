<?php
namespace System\Subscribers\Auth\Subscribers;
class Logout{
	public function onLogout($user)
	{
		return true;
	}
}
?>