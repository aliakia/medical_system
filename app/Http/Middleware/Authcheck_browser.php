<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Response;

class Authcheck_browser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        $platform = $agent->platform();
        // Ubuntu, Windows, OS X, ...
        $browser = $agent->browser();
        // Chrome, IE, Safari, Firefox, ...
        $browser_version = $agent->version($browser);
        $platform_version = $agent->version($platform);
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];

        if ($agent->is('Firefox') == false) {

           //return redirect(route('admin',Session('data_clinic')->clinic_id))->with('fail','You must be logged in');
           return response()->view('content/miscellaneous/error_browser', [
                'pageConfigs' => $pageConfigs
            ]);
         }
        return $next($request);
    }
}
