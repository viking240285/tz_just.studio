<?php

namespace App\Providers;

use App\Controllers\RestApiCarsController;
use Roots\Acorn\Sage\SageServiceProvider;

class RestApiServiceProvider extends SageServiceProvider {
    public function register() {
        $this->app->singleton(RestApiCarsController::class, function ($app) {
            return new RestApiCarsController();
        });
    }

    public function boot() {
        $this->app->get(RestApiCarsController::class)->register_routes();
    }
}
