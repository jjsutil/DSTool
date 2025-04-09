<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForceChangePassword
{
    public function handle(Request $request, Closure $next): Response
    {
        if (is_null(Auth::user()) || App::environment(['local', 'development'])) {
            return $next($request);
        }
        //        if (is_null($request->user()?->updated_at)) {
        //            return redirect()->route('profile.show')
        //                ->with('error', 'You must change your password to continue.');
        //        } TODO consider implementation
        return $next($request);
    }
}
