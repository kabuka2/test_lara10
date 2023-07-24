<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{



    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    public const LOGIN = '/login';
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/web.php'));
        });
    }

//    public function boot(): void
//    {
//        $this->configureRateLimiting();
//    }

    public function map():void
    {
        $this->getMapApiRouter();
        $this->getMapUserRouters();
    }

    /** map api **/
    public function getMapApiRouter():void
    {
        Route::prefix('api')
            ->middleware(['api'])
            ->group(base_path('routes/api/api.php'));
    }

    /** map user **/
    public function getMapUserRouters():void
    {
        Route::middleware('web')
//            ->namespace('App\Http\Controllers')
            ->group(base_path('routes/web/web.php'));
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

}
