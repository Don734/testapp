<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('current_user', Auth::user());
        });

        view()->composer(['', 'dashboard', 'tables.materials', 'reports', 'users', 'groups', 'settings'], function ($view) {
            $user = Auth::user();

            $view->with('notifications', $user->notifications);
            $view->with('unreadNotifications', $user->unreadNotifications);
        });
    }
}
