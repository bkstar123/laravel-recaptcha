<?php
/**
 * Recaptcha
 *
 * @author: tuanha
 * @last-mod: 09-June-2019
 */

namespace Bkstar123\LaravelRecaptcha\Facades;

use Illuminate\Support\Facades\Facade;

class Recaptcha extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'recaptcha';
    }
}
