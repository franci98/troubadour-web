<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->modifyEmailVerificationEmail();
    }

    private function modifyEmailVerificationEmail()
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('[' . strtoupper(env('APP_NAME')) . '] ' . __('messages.verify_email_subject'))
                ->greeting(__('messages.email_greeting'))
                ->line(__('messages.verify_email_body'))
                ->action(__('messages.verify_email_button'), $url)
                ->salutation(__('messages.verify_email_salutation'));
        });
    }
}
