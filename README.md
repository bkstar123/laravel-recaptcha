# laravel-recaptcha

## 1.Requirements  

It is recommended to install this package with PHP version 7.1.3 & higher and Laravel Framework version 5.4.* & higher

## 2.Installation  
    composer require bkstar123/laravel-recaptcha 

Add the following settings in the .env file:   
    ```GOOGLE_RECAPTCHA_KEY=<your-google-recaptcha-v2-key>```  
    ```GOOGLE_RECAPTCHA_SECRET=<your-google-recpatcha-v2-secret>```

## 3.Usage

### 3.1 In blade view

You can add Google reCaptcha v2 validation to your site by simply calling
    ```{{ Recaptcha::addClient() }}```   

**Note**: **Recaptcha** alias is automatically registered, so you do not need to add it in the `config/app.php`

The following input will be automatically added to your view and being validated in the validation logic  
```html 
<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response"></textarea>
``` 

You can also display the validation result to the view as follows (use CSS styling to highlight the validation error):    

```html
<div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
    <div class="col-md-12">
        {{ Recaptcha::addClient() }}
        @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
        @endif
    </div>
</div>
```

### 3.2 In validation logic

You can use a new custom validation rule `recaptcha` against the attribute `g-recaptcha-response`, for example:  
```php
$request->validate([
    'g-recaptcha-response' => 'required|recaptcha'
], [
    'g-recaptcha-response.recaptcha' => 'Please make sure you are not a robot',
    'g-recaptcha-response.required' => 'Re-captcha field is required'
]);
```