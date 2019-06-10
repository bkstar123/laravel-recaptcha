<?php
/**
 * recaptcha settings
 *
 * @author: tuanha
 * @last-mod: 09-June-2019
 */

return [
    'key' => env('GOOGLE_RECAPTCHA_KEY', ''),
    'secret' => env('GOOGLE_RECAPTCHA_SECRET', ''),
    'key3' => env('GOOGLE_RECAPTCHA3_KEY', ''),
    'secret3' => env('GOOGLE_RECAPTCHA3_SECRET', ''),
];
