<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DebugBarApiResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            if ($response instanceof JsonResponse && env('DEBUGBAR_API_ENABLED') === true) {
                $queries_data = $this->sqlFilter(app('debugbar')->getData());

                $response->setData(json_decode($response->getContent(), true) + [
                    '_debugbar' => [
                        'total_queries' => count($queries_data),
                        'queries' => $queries_data,
                        'time' => app('debugbar')?->getData()['time'] ?? '',
                        'memory' => app('debugbar')?->getData()['memory'] ?? '',
                    ],
                ]);
            }

            return $response;
        } catch (\Exception $e) {
            return $response;
        }
    }

    /**
     * Get only sql and each duration
     *
     * @param $debugBarData
     * @return array
     */
    protected function sqlFilter($debugBarData)
    {
        $result = Arr::get($debugBarData, 'queries.statements');

        if (is_null($result)) {
            return [];
        }

        return array_map(function ($item) {
            return [
                'sql' => Arr::get($item, 'sql'),
                'duration' => Arr::get($item, 'duration_str'),
            ];
        }, $result);
    }
}
