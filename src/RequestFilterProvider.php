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
            __DIR__ . '/../config/filters.php' => config_path('filters.php'),
        ], 'laravel-filters');

        if ($this->app->runningInConsole()) {
            $this->commands(FilterMakeCommand::class);
        }

        $this->app->resolving(FormRequest::class, function (FormRequest $request, $app) {
            if (method_exists($request, 'filters')) {
                $filtersArr = app()->call([$request, 'filters'], []);
                foreach ($filtersArr as $key => $filters) {
                    foreach (explode('|', $filters) as $filter) {
                        /** @var Filter $filterInstance */
                        $subFilters = explode(":", $filter);
                        if (isset($subFilters[1])) $filter = $subFilters[0];
                        $filterClass = config('filters.aliases.' . $filter);
                        $filterInstance = app($filterClass);

                        $value = $request->input($key);
                        $request->offsetSet($key, $filterInstance->filter($value, $key, $filtersArr, $filters));
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
        $this->mergeConfigFrom(__DIR__ . '/../config/filters.php', 'filters');
    }
}
