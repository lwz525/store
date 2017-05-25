<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //注册mail
        $this->app->singleton('mailer',function($app){
            $app->configure('services');
            $app->configure('mail');
            return $app->loadComponent('mail','Illuminate\Mail\MailServiceProvider','mailer');
        });
    }
    public function boot()
    {
        \Carbon\Carbon::setLocale('zh');
        Validator::extend('vermobile',function($attribute,$value,$parameters,$validator){
            return $value;
        });
        Validator::extend('check_phone',function($attribute,$value,$parameters,$validator){
            if(preg_match("/1[34578]{1}\d{9}$/", $value)){
                return true;
            }
            return false;
        });
    }
}
