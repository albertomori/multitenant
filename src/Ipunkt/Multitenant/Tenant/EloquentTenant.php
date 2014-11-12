<?php namespace Ipunkt\Multitenant\Tenant;

use Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

/**
 * Class EloquentTenant
 * @package Ipunkt\Multitenant\Tenant
 * 
 * Represents a Tenant object which was loaded from the database through Eloquent
 * @property string $prefix
 * @property UserInterface[]|Collection $users
 */
class EloquentTenant extends Eloquent implements Tenant {
	/**
	 * Returns the unique prefix that identifies this tenant
	 *
	 * @return mixed
	 */
	public function getPrefix() {
		return $this->prefix;
	}

	/**
	 * Returns the id by which this tenant can be retrieved from the repository
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->getKey();
	}

	/**
	 * Returns true if the tenant has this user assigned to it.
	 *
	 * @param UserInterface $user
	 * @return bool
	 */
	public function hasUser(UserInterface $user) {
		$hasUser = false;
		foreach($this->users as $myUser) {
			if($user->getAuthIdentifier() == $myUser->getAuthIdentifier()) {
				$hasUser = true;
				break;
			}
		}
		
		return $hasUser;
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function users() {
		$userModel = Config::get('auth.model');
		return $this->belongsToMany($userModel, 'user_tenants');
	}
} 