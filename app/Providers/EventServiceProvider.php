<?php

namespace App\Providers;

use App\Events\DeleteMessagesEnabled;
use App\Events\DeleteNotificationsEnabled;
use App\Events\MessageCreated;
use App\Events\OrderStatusUpdated;
use App\Listeners\DeleteMessages;
use App\Listeners\DeleteNotifications;
use App\Listeners\SendMessageCreatedEmail;
use App\Listeners\SendMessageCreatedNotification;
use App\Listeners\SendOrderStatusUpdatedEmail;
use App\Listeners\SendOrderStatusUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderStatusUpdated::class => [
            SendOrderStatusUpdatedEmail::class,
            SendOrderStatusUpdatedNotification::class
        ],
        DeleteNotificationsEnabled::class => [
            DeleteNotifications::class
        ],
        MessageCreated::class => [
            SendMessageCreatedEmail::class,
            SendMessageCreatedNotification::class
        ],
        DeleteMessagesEnabled::class => [
            DeleteMessages::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            $event->user->log("Logged in");
        });
        Event::listen(\Illuminate\Auth\Events\Logout::class, function ($event) {
            $event->user->log("Logged out");
        });
        Event::listen(\Illuminate\Auth\Events\Registered::class, function ($event) {
            $event->user->log("Registered");
        });
    }
}
