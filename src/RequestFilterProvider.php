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

                        $filteredValue = $filterInstance->filter($request->input($key), $key, $filtersArr, $filters);
                        $data = $this->updateValue($request->all(), $key, $filteredValue);

                        $request->merge($data);
                    }
                }
            }
        });
    }

    /**
     * @param $data
     * @param $key
     * @param $newValue
     * @return mixed
     */
    private function updateValue($data, $key, $newValue)
    {
        $lastKey = explode('.', $key);
        $lastKey = end($lastKey);

        $replicate = [
            'key' => $lastKey,
            'value' => $newValue
        ];

        array_walk_recursive($data, function (&$item, $key) use ($replicate) {
            if (strcmp($replicate['key'], $key) == 0) {
                $item = $replicate['value'];
            }
        });

        return $data;
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/filters.php', 'filters');
    }
}
