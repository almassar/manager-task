<?php

namespace App\Providers;

use App\Modules\Flash\Flash;
use App\Modules\Tasks\TaskRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

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
        $pathBuildCssJs = config('app.env') === 'local' ? 'build/developer' : 'build';
        view()->share('pathBuildCssJs', $pathBuildCssJs);

        $this->app->singleton('flash', function(Container $app) {
            return new Flash($app['session.store']);
        });

        $this->app->singleton('reminders', function(Container $app) {
            $taskRepository = new TaskRepository(app());
            return $taskRepository->getTaskForMe()->get();
        });


    }
}
