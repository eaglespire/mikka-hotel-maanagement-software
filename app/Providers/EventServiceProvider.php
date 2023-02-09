<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Permission;
use App\Models\Postcategory;
use App\Models\Pricing;
use App\Models\Role;
use App\Models\Room;
use App\Models\Setting;
use App\Models\Tax;
use App\Models\User;
use App\Observers\AboutPageSettingsObserver;
use App\Observers\EventObserver;
use App\Observers\FaqObserver;
use App\Observers\FeatureObserver;
use App\Observers\PermissionObserver;
use App\Observers\PostCategoryObserver;
use App\Observers\PricingObserver;
use App\Observers\RoleObserver;
use App\Observers\RoomObserver;
use App\Observers\SettingObserver;
use App\Observers\StaffObserver;
use App\Observers\TaxObserver;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(StaffObserver::class);
        Role::observe(RoleObserver::class);
        Permission::observe(PermissionObserver::class);
        Feature::observe(FeatureObserver::class);
        \App\Models\Event::observe(EventObserver::class);
        Room::observe(RoomObserver::class);
        Setting::observe(SettingObserver::class);
        About::observe(AboutPageSettingsObserver::class);
        Faq::observe(FaqObserver::class);
        Pricing::observe(PricingObserver::class);
        Postcategory::observe(PostCategoryObserver::class);
        Tax::observe(TaxObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
