<?php namespace Ipunkt\Multitenant\Tenant;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Collection;


/**
 * Interface TenantRepository
 * 
 * Provides Access to Tenant type objects
 */
interface TenantRepository {
	/**
	 * Returns all Tenants this user has access to.
	 *
	 * @param UserInterface $user
	 * @return Tenant[]|Collection
	 */
	function byUser(UserInterface $user);

	/**
	 * Returns all known Tenants
	 * 
	 * @return Tenant[]|Collection
	 */
	function all();

	/**
	 * Returns the Tenant with the given id or null if it does not exist.
	 *
	 * @param $id
	 * @return Tenant|null
	 */
	function byId($id);
} 