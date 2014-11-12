<?php namespace Ipunkt\Multitenant\Tenant;
use Illuminate\Auth\UserInterface;


/**
 * Interface Tenant
 * @package Ipunkt\Multitenant\Tenant
 */
interface Tenant {
	/**
	 * Returns the unique prefix that identifies this tenant
	 * 
	 * @return mixed
	 */
	function getPrefix();

	/**
	 * Returns the id by which this tenant can be retrieved from the repository
	 * 
	 * @return mixed
	 */
	function getId();

	/**
	 * Returns true if the tenant has this user assigned to it.
	 *
	 * @param UserInterface $user
	 * @return bool
	 */
	function hasUser(UserInterface $user);
} 