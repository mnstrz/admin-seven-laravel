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
         * @method inputText
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputText', 'components.form-collective.input-text', ['column','label','attributes' => [],'help']);

        /**
         * @method inputEmail
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputEmail', 'components.form-collective.input-email', ['column','label','attributes' => [],'help']);

        /**
         * @method inputPassword
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputPassword', 'components.form-collective.input-password', ['column','label','attributes' => [],'help']);

        /**
         * @method inputDate
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputDate', 'components.form-collective.input-date', ['column','label','attributes' => [],'help']);

        /**
         * @method inputDatetime
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputDatetime', 'components.form-collective.input-date-time', ['column','label','attributes' => [],'help']);

        /**
         * @method inputDaterange
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputDaterange', 'components.form-collective.input-date-range', ['column','label','attributes' => [],'help']);

        /**
         * @method inputDatetimerange
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputDatetimerange', 'components.form-collective.input-date-time-range', ['column','label','attributes' => [],'help']);

        /**
         * @method selectOption
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param array $options
         * @param string help
         */
        \Form::component('selectOption', 'components.form-collective.select', ['column','label','attributes' => [],'options' => [], 'help']);

        /**
         * @method inputNumber
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputNumber', 'components.form-collective.input-number', ['column','label','attributes' => [], 'help']);

        /**
         * @method inputTextAppend
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputTextAppend', 'components.form-collective.input-text-append', ['column','label','attributes' => [], 'help']);

        /**
         * @method inputColor
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputColor', 'components.form-collective.input-color', ['column','label','attributes' => [], 'help']);

        /**
         * @method inputTime
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputTime', 'components.form-collective.input-time', ['column','label','attributes' => [], 'help']);

        /**
         * @method selectCheckbox
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param array $options
         * @param array $values
         * @param string help
         */
        \Form::component('selectCheckbox', 'components.form-collective.checkbox', ['column','label','attributes' => [], 'options' => [], 'values' => [], 'help']);

        /**
         * @method selectRadio
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param array $options
         * @param string help
         */
        \Form::component('selectRadio', 'components.form-collective.radio', ['column','label','attributes' => [], 'options' => [], 'help']);

        /**
         * @method uploadFile
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string $path
         * @param string help
         */
        \Form::component('uploadFile', 'components.form-collective.upload', ['column','label','attributes' => [],'path', 'help']);

        /**
         * @method uploadFile
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param array $setting
         * @param string $path
         * @param string help
         */
        \Form::component('uploadImage', 'components.form-collective.upload_image', ['column','label','attributes' => [],'setting' => [],'path', 'help']);

        /**
         * @method inputTextarea
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputTextarea', 'components.form-collective.text-area', ['column','label','attributes' => [], 'help']);

        /**
         * @method inputTextEditor
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputTextEditor', 'components.form-collective.text-editor', ['column','label','attributes' => [], 'help']);

        /**
         * @method inputTextCode
         * @param array $column
         * @param string $label
         * @param array $attributes
         * @param string help
         */
        \Form::component('inputTextCode', 'components.form-collective.text-code', ['column','label','attributes' => [], 'help']);

        /**
         * @method dropZone
         * @param array $attributes
         * @param string help
         */
        \Form::component('dropZone', 'components.form-collective.dropzone',['attributes' => [], 'existing' => []]);
    }
}
