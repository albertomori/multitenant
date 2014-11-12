<?php namespace Ipunkt\Multitenant;
use Ipunkt\Multitenant\Tenant\Tenant;

/**
 * Interface MultitenantInterface
 * @package Ipunkt\Multitenant
 * 
 * Facade to the Multitenant system - specification
 */
interface MultitenantInterface {
	/**
	 * Attempts to collect the tenant that was previously set by the user
	 */
	function collectTenant();

	/**
	 * Returns the currently set tenant for the user or NULL if none was set
	 * 
	 * @return Tenant|null
	 */
	function getTenant();

	/**
	 * @return
	 */
	function setTenant(Tenant $tenant);
} 