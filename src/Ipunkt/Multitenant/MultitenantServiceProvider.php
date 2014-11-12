<?php namespace Ipunkt\Multitenant;

use Illuminate\Support\ServiceProvider;

class MultitenantServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
	
	public function boot() {
		$this->package('ipunkt/multitenant');
		$this->app->bind('Ipunkt\Multitenant\MultitenantInterface', 'Ipunkt\Multitenant\MultitenantObject');
		require_once('../../routes.php');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
