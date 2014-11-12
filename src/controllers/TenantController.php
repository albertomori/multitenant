<?php

use Illuminate\Auth\UserInterface;
use Ipunkt\Multitenant\Multitenant;
use Ipunkt\Multitenant\Tenant\Tenant;
use Ipunkt\Multitenant\Tenant\TenantRepository;

class TenantController extends BaseController {

	/**
	 * @var UserInterface
	 */
	protected $user;
	
	/**
	 * @var TenantRepository
	 */
	private $repository;

	/**
	 * @param TenantRepository $repository
	 */
	public function __construct(\Ipunkt\Multitenant\Tenant\TenantRepository $repository) {
		$this->repository = $repository;
		$this->user = Auth::user();
	}
	
	/**
	 * Provides the form to chose one out of the users current tenants
	 */
	public function getChose() {
		$response = null;
		
		$tenants = $this->repository->byUser($this->user);
		
		if($tenants > 1)
			$response = View::make('multitenant::chose');
		else if($tenants < 1)
			$response = Redirect::route('multitenant.apply');
		else
			$response = $this->redirectBack();
		
		return $response;
	}
	
	protected function redirectBack() {
		$url = Session::get('tenant_from_url', '/');
		
		return Redirect::to($url);
	}

	/**
	 * Provides a 
	 */
	public function getApply() {
		$response = null;
		
		$response = View::make('multitenant::apply');
		
		return $response;
	}
	
} 