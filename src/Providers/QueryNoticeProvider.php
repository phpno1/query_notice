<?php

namespace BugsLife\QueryNotice\Providers;

use BugsLife\QueryNotice\Notice;
use Illuminate\Support\ServiceProvider;

class QueryNoticeProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot(Notice $notice)
    {
        $this->publishes([
            //Set config
            __DIR__ . '/../config/queryNotice.php' => config_path('queryNotice.php'),
            //Set mail view
            __DIR__ . '/../views/mail/query-notice.blade.php' => resource_path('views/query-notice/mail/query-notice.blade.php'),
            //Set db view
            __DIR__ . '/../views/database/index.blade.php' => resource_path('views/query-notice/database/index.blade.php')
        ], 'queryNotice');


        /*
         * Create config
         */
        $this->mergeConfigFrom(__DIR__ . '/../config/queryNotice.php', 'queryNotice');

        /*
         * Create mail view
         */
        $this->loadViewsFrom(__DIR__ . '/../views/mail/query-notice.blade.php', 'queryNotice');

        /*
         * Create Db view
         */
        $this->loadViewsFrom(__DIR__ . '/../views/database/index.blade.php', 'queryNotice');

        /*
         * Notice open all object.
         */
        if (config('queryNotice.is_all_object')) {
            $notice->notice();
        }

        /*
         * Router
         */
        $this->loadRoutesFrom(__DIR__ . '/../Routers/Route.php');

        /*
         * Migrations
         */
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {
        $this->app->bind(\BugsLife\QueryNotice\Notice::class, \BugsLife\QueryNotice\QueryNotice::class);
    }
}