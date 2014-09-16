<?php namespace Helper\FileHelper;

use Illuminate\Support\ServiceProvider;

class FileHelperServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
   /*
    * run
    *
    */
    public function boot()
    {
        $this->package('helper/fileHelper');
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
        $this->app['fileHelper'] = $this->app->share(function($app) {
                return new FileHelper;
                });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('fileHelper');
	}

}
