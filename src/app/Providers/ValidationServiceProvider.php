<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ValidationServiceProvider extends ServiceProvider
{

    /**
     * All custom rules can be added here.
     *
     * @var Array
     */
    private $rules = [
        'disallowed_parameter' => [
            'message' => 'The `:attribute` field is not allowed.'
        ]
    ];

    /**
     * Bootstrap any validation services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->rules as $name => $options) {
            Validator::extend($name, function ($attribute, $value, $parameters, $validator) use ($name) {
                $callbackName = 'validate' . Str::studly($name);
                $validator->setCustomMessages([$name => $this->rules[$name]['message']]);
                return $this->{$callbackName}($attribute, $value, $parameters, $validator);
            });
        }
    }

    /**
     * The custom validation for disallowed parameter.
     *
     * @return boolean
     */
    public function validateDisallowedParameter($attribute, $value, $parameters, $validator)
    {
        return false;
    }
}
