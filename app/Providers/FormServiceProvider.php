<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * @param $column, $name, $value, $label, $placeholder, $info, $atributes, $events
         */
        \Form::component('inputText', 'components.form.text', ['column','name', 'value' => null, 'label', 'placeholder', 'info' => null, 'attributes' => [], 'events' => [] ]);
    }
}
