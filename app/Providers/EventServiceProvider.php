<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
		 \Illuminate\Auth\Events\Failed::class => [
            \App\Listeners\RecordFailedLoginAttempt::class,
        ],
		 \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\LoginAttempt::class,
        ],
		 \Illuminate\Auth\Events\PasswordReset::class => [
            \App\Listeners\PasswordResetAttempt::class,
        ],
		 \Illuminate\Auth\Events\Lockout::class => [
            \App\Listeners\LockoutUser::class,
        ],
		 \Illuminate\Auth\Events\Verified::class => [
            \App\Listeners\VerifiedUser::class,
        ],
		 \Illuminate\Auth\Events\Registered::class => [
            \App\Listeners\RegisteredUser::class,
        ],
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
