<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\rapporta;
use App\Models\etat;


class NotificationsCountComposer extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer(['correcteur', 'notification'], function ($view) {
            $usersociete = \Auth::user()->societe;
            $notificationscount = Notification::whereHas('etat.rapporta', function ($query) use ($usersociete) {
                $query->where('client', $usersociete);
            })->count();
            $view->with('notificationscount', $notificationscount);
        });
    }
}
