<?php namespace Iserter\Transunion;


class ServiceProvider extends \Illuminate\Support\ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/transunion.php';
        $this->mergeConfigFrom($configPath, 'transunion');

        $this->app->singleton('Iserter\Transunion\Contracts\TransunionServiceInterface', function ($app) {
            return new TransunionService();
        });
        
    }

    public function boot(){
        $configPath = __DIR__ . '/../config/transunion.php';
        $this->publishes([$configPath => config_path('transunion.php')], 'config');
    }


}