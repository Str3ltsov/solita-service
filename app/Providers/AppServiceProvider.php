<?php

namespace App\Providers;

use App\Events\DeleteMessagesEnabled;
use App\Events\DeleteNotificationsEnabled;
use App\Listeners\DeleteNotifications;
use App\Traits\NotificationServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    use NotificationServices;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Change public path to htdocs
//        $this->app->bind('path.public', function() {
//           return base_path('htdocs');
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        //Force app to use https
//        URL::forceScheme('https');

        Schema::defaultStringLength(191);

        View::composer('*', function($view) use($request)
        {
            if (Auth::check()) {
                $notifications = $this->getUnreadNotificationsByUserId(Auth::user()->id);

                event(new DeleteNotificationsEnabled(Auth::user()->id, Auth::user()->delete_notifications));
                event(new DeleteMessagesEnabled(Auth::user()->id, Auth::user()->delete_messages));

                $view->with([
                    'prefix' => $request->prefix ?? strtolower(auth()->user()->role->name) ?? 'client',
                    'notificationCount' => $this->getNotificationNumber($notifications)
                ]);
            }
            else $view->with('prefix', 'client');
        });
    }
}
