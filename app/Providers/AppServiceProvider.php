<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\Question;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(
            function ($user, $ability) {
                return $user->hasRole('admin') ? true : null;
            }
        );

        view()->composer('*', function ($view)
        {
            $auth = Auth::user();
            $setting = Setting::whereId(1)->first();
            $c_questions = Question::count();
            $view->with(['auth' => $auth, 'setting' => $setting, 'c_questions' => $c_questions]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
