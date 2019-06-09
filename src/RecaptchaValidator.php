<?php
/**
 * Custom validator for re-captcha
 *
 * @author: tuanha
 * @last-mod: 09-June-2019
 */

namespace Bkstar123\LaravelRecaptcha;

use GuzzleHttp\Client;

class RecaptchaValidator
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $HttpClient;

    /**
     * Initialize class instance
     *
     * @return void
     */
    public function __construct(Client $HttpClient)
    {
        $this->HttpClient = $HttpClient;
    }

    /**
     * Validate 'g-recaptcha-response' attribute
     *
     * @param string  $attribute
     * @param string  $value
     * @param array  $parameters
     * @param \Illuminate\Validation\Validator  $validator
     *
     * @return boolean
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        $response = $this->HttpClient->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                [
                    'secret'=> config('bkstar123_recaptcha.secret'),
                    'response'=> $value
                ]
            ]
        );
    
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }
}
