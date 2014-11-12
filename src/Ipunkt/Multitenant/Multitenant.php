<?php namespace Ipunkt\Multitenant;

use Illuminate\Support\Facades\Facade;

/**
 * Class Multitenant
 * @package Ipunkt\Multitenant
 * 
 * Laravel Facade which wraps around the actual MultitenantInterface Facade
 */
class Multitenant extends Facade {
	static public function getFacadeAccessor() { return 'Ipunkt\Multitenant\MultitenantInterface'; }
} 