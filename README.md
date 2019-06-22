# laravel-recaptcha  
This package adds reCaptcha_v2 Checkbox and reCaptcha_v3 validation. Both versions of reCaptcha can be used together

## 1.Requirements  

It is recommended to install this package with PHP version 7.1.3+ and Laravel Framework version 5.5+  

## 2.Installation  
    composer require bkstar123/laravel-recaptcha 

For `reCaptcha_v2 Checkbox`, add the following settings in the .env file:   
    ```GOOGLE_RECAPTCHA_KEY=<your-google-recaptcha-v2-key>```  
    ```GOOGLE_RECAPTCHA_SECRET=<your-google-recpatcha-v2-secret>```  

For `reCaptcha_v3`, add the following settings in the .env file:   
    ```GOOGLE_RECAPTCHA3_KEY=<your-google-recaptcha-v3-key>```  
    ```GOOGLE_RECAPTCHA3_SECRET=<your-google-recpatcha-v3-secret>```  
    ```GOOGLE_RECAPTCHA3_THRESHOLD=<your-desired-score-to-decide-this-is-a-human>``` (optional, by default set to 0.5)  

## 3. Usage for reCaptcha v2 checkbox  

### 3.1 In Blade view

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

## 4. Usage for reCaptcha v3  

### 4.1 In Blade view  

**Firstly**, you need to call `addClient3Html()` method on `Recaptcha` facade, for example:  
```php
{{ Recaptcha::addClient3Html('recaptcha3') }}
```

This call will create a hidden input as follows:  
```html
<input type="hidden" name="recaptcha3" id="recaptcha3">
```

You can display the validation error by adding the following snippet:  
```html
@if ($errors->has('recaptcha3'))
    <span class="help-block">
        <strong>{{ $errors->first('recaptcha3') }}</strong>
    </span>
@endif
```

**Secondly**, you need to call `addClient3Js()` method on `Recaptcha` facade, for example:  
```php
{{ Recaptcha::addClient3Js('<action_name>', 'recaptcha3') }} 
```

This call will create a Javascript block as follows:  
```javascript
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<SITE-KEY>', {action: '<action_name>'})
                  .then(function (token) {
                    if (token) {
                        document.getElementById('recaptcha3').value = token;
                    }
                  });
    });
</script>
```

### 4.2 In Validation logic

You can use a new custom validation rule `recaptcha_v3` against the attribute `recaptcha3`, for example:  
```php
$request->validate([
    'recaptcha3' => 'recaptcha_v3'
], ['recaptcha_v3' => 'You are not a human']);
``` 

**Note**:  
- You can give an arbitrary name for `action_name` as long as it contains only a-z, A-Z and _  
- Also for attribute name, you can use an arbitrary string other than `recaptcha3`