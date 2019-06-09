<?php
/**
 * RecaptchaClient
 *
 * @author: tuanha
 * @last-mod: 09-June-2019
 */

namespace Bkstar123\LaravelRecaptcha;

class RecaptchaClient
{
    /**
     * Render recaptcha field
     *
     * @return HTML DOM string
     */
    public function addClient()
    {
        $contents = '<div class="g-recaptcha" data-sitekey="'.
                    config('bkstar123_recaptcha.key').
                    '"></div>';
        $contents .= '<script src="https://www.google.com/recaptcha/api.js"></script>';
        echo $contents;
    }
}
