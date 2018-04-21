<?php
namespace Order\Classes;
class OrderConfig
{
	static $_config=[];

	public static function __initialize()
	{
		self::$_config['default_payment_method'] = 'paytm';
		self::$_config['payment_method'] = [
										'cash',
										'card',
										'netbanking',
										'paytm',
									];

		self::$_config['statuses'] = [
										'completed',
										'cancelled',
										'pending',
										'processing',
										'refunded',
										'expired'
									];

		self::$_config['client'] = [
								'cancelled',
								'refunded'
								];

	}

	public static function setConfig($code, $value)
	{
		$old = null;
		if(array_key_exists($code,self::$_config))
		{
			$old = self::$_config[$code];
			self::$_config[$code] = $value;
		}
		return $old;
	}

	public static function unsetConfig($code)
	{
		$old = null;
		if(array_key_exists($code,self::$_config))
		{
			$old = self::$_config[$code];
			unset(self::$_config[$code]);
		}
		return $old;
	}

	public static function getConfig($code, $default = null)
	{

		if(array_key_exists($code,self::$_config))
		{
			return self::$_config[$code];
		}
		return $default;
	}

}
?>