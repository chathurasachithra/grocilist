<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Validation rule for checking if any scripts inserted in input field
        Validator::extend('script_tags_free', function ($attribute, $value, $parameters, $validator) {
            $originalValue = $value;
            $value = strip_tags($value);

            if (strlen($originalValue) == strlen($value)) {
                return true;
            } else {
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
