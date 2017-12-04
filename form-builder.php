<?php
namespace VSamFormBulder;

defined( 'ABSPATH' ) or die();

spl_autoload_register(function($class) {
		if(strpos($class, 'VSamFormBulder\\') !== false) {
			$pach = dirname(__FILE__) . '\\' . $class . '.php';
			require $pach;
		}
		return;
	}
);