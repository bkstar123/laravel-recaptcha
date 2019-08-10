<?php
/**
* LaravelRecaptchaServiceProvider
*
* @author: tuanha
* @last-mod: 09-June-2019
*/

namespace Bkstar123\LaravelRecaptcha;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Bkstar123\LaravelRecaptcha\RecaptchaClient;
use Bkstar123\LaravelRecaptcha\Facades\Recaptcha;

class LaravelRecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('recaptcha', '\Bkstar123\LaravelRecaptcha\RecaptchaValidator@validate');
        Validator::extend('recaptcha_v3', '\Bkstar123\LaravelRecaptcha\RecaptchaV3Validator@validate');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('recaptcha', function ($app) {
            return new RecaptchaClient;
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('Recaptcha', Recaptcha::class);
        
        $this->mergeConfigFrom(__DIR__.'/Config/bkstar123_recaptcha.php', 'bkstar123_recaptcha');
    }
}
