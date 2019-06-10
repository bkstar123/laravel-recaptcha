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

    /**
     * Render recaptcha_v3 html hidden input
     *
     * @return HTML DOM string
     */
    public function addClient3Html($attribute = 'recaptcha3')
    {
        $contents = '<input type="hidden" name="'.$attribute.'" id="'.$attribute.'">';
        echo $contents;
    }

    /**
     * Add recaptcha_v3 javascript
     */
    public function addClient3Js($action = 'others', $attribute = 'recaptcha3')
    {
        $contents = '<script src="https://www.google.com/recaptcha/api.js?render='.
                     config('bkstar123_recaptcha.key3').
                     '"></script>';
        $contents .= '<script>grecaptcha.ready(function() {';
        $contents .= 'grecaptcha.execute("';
        $contents .= config('bkstar123_recaptcha.key3');
        $contents .= '", {action: "'.$action.'"})';
        $contents .= '.then(function (token) {';
        $contents .= 'if (token) {';
        $contents .= 'document.getElementById("'.$attribute.'").value = token;';
        $contents .= '}});});</script>';
        echo $contents;
    }
}
