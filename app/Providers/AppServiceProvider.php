<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {/*
        VerifyEmail::toMailUsing(function ($notifiable) {
            $verifyUrl = $this->verificationUrl($notifiable);

            // Return your mail here...
            return (new MailMessage)
                ->subject('Verify your email address')
                ->markdown('emails.verify', ['url' => $verifyUrl]);
        });*/
    }
}
