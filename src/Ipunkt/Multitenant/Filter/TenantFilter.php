<?php namespace Ipunkt\Multitenant\Filter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Ipunkt\Multitenant\Multitenant;
use Ipunkt\Multitenant\Tenant\TenantRepository;

/**
 * Class TenantFilter
 * 
 * This filter takes care of handling tenant choosing.
 *
 * Case 1, User has selected a tenant:
 * If the user has selected a tenant he has access to:
 *      Do nothing and let the request pass.
 * If the user has selected a tenant he has no access to:
 *      Reset selection to not selected.
 * 
 * Case 2, User has not selected a tenant:
 * If the user has not selected a tenant and only has one:
 *      set the only tenant to be active
 * If the user has not selected a tenant and has more than one:
 *      Redirect the User to the 'chose Tenant' Page
 * If the user has not selected a tenant and does not have a tenant:
 *      Redirect the user to the 'Create or apply to tenant' Page
 */
class TenantFilter {

	/**
	 * @var TenantRepository
	 */
	private $repository;

	/**
	 * @param TenantRepository $repository
	 */
	public function __construct(TenantRepository $repository) {

		$this->repository = $repository;
	}

	/**
	 * @return null
	 */
	public function filter() {
		$response = null;
		
		if(Auth::guest()) {
			$response = Redirect::to('/login');
		} else {
			Multitenant::collectTenant();
			
			if( null === Multitenant::getTenant() ) {
				$userTenants = $this->repository->byUser(Auth::get());
				if($userTenants->count() == 1)
					Multitenant::setTenant($userTenants->first());
				else if($userTenants->count() < 1)
					// Redirect to apply page
					$response = Redirect::route('tenant.apply');
				else // ($userTenants->count() > 1)
					// Redirect to chose page
					$response = Redirect::route('tenant.chose');
			}
		}
		
		return $response;
	}
} 