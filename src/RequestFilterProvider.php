<?php

namespace Abstractrs\Form\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\ServiceProvider;
use Abstractrs\Form\Request\Filters\Contracts\Filter;

class RequestFilterProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/filters.php' => config_path('filters.php'),
        ], 'laravel-filters');

        if ($this->app->runningInConsole()) {
            $this->commands(FilterMakeCommand::class);
        }

        $this->app->resolving(FormRequest::class, function (FormRequest $request, $app) {
            if (method_exists($request, 'filters')) {
                foreach (app()->call([$request, 'filters'], []) as $key => $filters) {
                    foreach (explode('|', $filters) as $filter) {
                        /** @var Filter $filterInstance */
                        $filterClass = config('filters.aliases.' . $filter);
                        $filterInstance = app($filterClass);
                        $requestValue = $request->get($key);
                        $request->offsetSet($key, $filterInstance->filter($requestValue));
                    }
                }
            }
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filters.php', 'filters');
    }
}
