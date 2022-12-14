<?php

namespace App\Providers;

use App\Events\Supply\SupplyItemDeletedEvent;
use App\Events\SupplyEvent;
use App\Events\SupplyItemEvent;
use App\Listeners\Supply\SupplyItemDeletedListener;
use App\Listeners\SupplyCreatedListener;
use App\Listeners\SupplyItemUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SupplyItemEvent::class => [
            SupplyItemUpdated::class,
        ],
        SupplyItemDeletedEvent::class => [
            SupplyItemDeletedListener::class,
        ]
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

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
