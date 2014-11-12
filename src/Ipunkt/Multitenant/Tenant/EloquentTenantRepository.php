<?php namespace Ipunkt\Multitenant\Tenant;

use Illuminate\Auth\UserInterface;
use Illuminate\Support\Collection;

/**
 * Class EloquentTenantRepository
 * @package Ipunkt\Multitenant\Tenant
 * 
 * Provides access to Tenant type objects through the Eloquent ORM
 */
class EloquentTenantRepository implements TenantRepository {
	/**
	 * Returns all Tenants this user has access to.
	 *
	 * @return Tenant[]|Collection
	 */
	public function byUser(UserInterface $user) {
		return EloquentTenant::whereUserId($user->getAuthIdentifier())->get();
	}

	/**
	 * Returns all known Tenants
	 *
	 * @return Tenant[]|Collection
	 */
	public function all() {
		return EloquentTenant::all();
	}

	/**
	 * Returns the Tenant with the given id or null if it does not exist.
	 *
	 * @param $id
	 * @return Tenant|null
	 */
	function byId($id) {
		return EloquentTenant::find($id);
	}


} 