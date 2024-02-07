<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowedInclude
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, ...$allowedIncludes): Response
    {
        if ($request->has('include')) {
            if (in_array('none', $allowedIncludes)) {
                return response()->json([
                    'error' => 'No includes allowed'
                ], 400);
            }

            $includes = explode(',', $request->get('include'));
            foreach ($includes as $include) {
                if (!in_array($include, $allowedIncludes)) {
                    return response()->json([
                        'error' => 'Include [' . $include . '] is not allowed'
                    ], 400);
                }
            }
        }

        return $next($request);
    }
}
