<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PublicRemove
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
        $url = $request->fullUrl();
        $urlComponents = parse_url($url);
        $path = parse_url($request->fullUrl(), PHP_URL_PATH);
        $desiredPart = dirname($path);
        $desiredPart = substr($desiredPart, 0, 7);
        if ($desiredPart == '/public') {
            abort(404, 'Not Found');
        } else {
            if ($request->routeIs('front.home')) {
                if ($desiredPart == '/') {
                    abort(404, 'Not Found');
                }
            }
            return $next($request);
        }
    }
}
