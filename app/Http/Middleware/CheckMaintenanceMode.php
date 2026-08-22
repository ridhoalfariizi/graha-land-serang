<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin/*') || $request->is('login') || $request->is('logout')) {
            return $next($request);
        }
        
        $maintenance = Setting::where('key', 'maintenance_mode')->value('value');
        if ($maintenance === '1') {
            return response()->view('errors.maintenance', [], 503);
        }
        
        return $next($request);
    }
}
