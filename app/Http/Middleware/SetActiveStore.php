<?php

namespace App\Http\Middleware;

use App\Models\Store;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class SetActiveStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        $store = Store::where('domain', $host)->first();
     
    
        $databaseConfig = json_decode($store->database_config, true);

        if (!$databaseConfig || !isset($databaseConfig['dbname'])) {
            // Handle case where database_config is not valid or does not contain dbname
            return response()->json(['message' => 'Invalid database configuration'], 500);
        }
        
        $db = $databaseConfig['dbname'];
        app()->instance('activeStore', $store);

        Config::set('database.connections.tenant.database', $db);

        return $next($request);
    }
}
