<?php
/**
 * Custom validator for reCaptcha_v3
 *
 * @author: tuanha
 * @last-mod: 10-June-2019
 */

namespace Bkstar123\LaravelRecaptcha;

class RecaptchaV3Validator
{
    /**
     * @param string  $attribute
     * @param string  $value
     * @param array  $parameters
     * @param \Illuminate\Validation\Validator  $validator
     *
     * @return boolean
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => config('bkstar123_recaptcha.secret3'),
            'response' => request($attribute)
        ];

        $options = [
            'http' => [
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = json_decode(file_get_contents($url, false, $context));

        return $response->success && $response->score > config('bkstar123_recaptcha.threshold3');
    }
}
