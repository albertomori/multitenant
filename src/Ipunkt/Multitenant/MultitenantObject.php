<?php namespace Ipunkt\Multitenant;

use Config;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Facades\Auth;
use Ipunkt\Multitenant\Tenant\Tenant;
use Ipunkt\Multitenant\Tenant\TenantRepository;
use Session;

/**
 * Class MultitenantObject
 * @package Ipunkt\Multitenant
 */
class MultitenantObject implements MultitenantInterface {
	
	const TENANT_SESSION = 'tenant';

	/**
	 * @var Tenant|null
	 */
	protected $tenant = null;

	/**
	 * @var TenantRepository
	 */
	protected $repository;
	
	/**
	 * @var UserInterface
	 */
	protected $user;

	/**
	 * @param TenantRepository $repository
	 */
	public function __construct(TenantRepository $repository) {
	    $this->repository = $repository;
		$this->user = Auth::user();
	}

	/**
	 * Helper function to create the necessary config key at a central point
	 * 
	 * @return string
	 */
	protected function getConfigKey() {
		return 'database.connections.'.Config::get('multitenant::tenant_connection');
	}

	/**
	 * @param Tenant $tenant
	 */
	public function setTenant(Tenant $tenant) {
		$success = false;
		
		if($tenant->hasUser($this->user)) {
			$this->tenant = $tenant;
	
			$configKey = $this->getconfigKey() . ".prefix";
			$prefix = Config::get($configKey);
			$prefix .= $tenant->getPrefix();
			Config::set($configKey, $prefix);
			
			Session::set(MultitenantObject::TENANT_SESSION, $tenant->getId());
			$success = true;
		}
		
		return $success;
	}

	/**
	 * @return null
	 */
	public function getTenant() {
		return $this->tenant;
	}

	/**
	 * Attempts to collect the tenant that was previously set by the user
	 */
	function collectTenant() {
		$tenantId = Session::get(MultitenantObject::TENANT_SESSION, null);
		if(null !== $tenantId) {
			$tenant = $this->repository->byId($tenantId);
			
			if(null !== $tenant)
				$this->setTenant($tenant);
		}
	}
} 