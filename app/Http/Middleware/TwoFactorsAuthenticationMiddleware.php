<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorsAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        //        if (is_null(Auth::user()) || App::environment(['local', 'development'])) {
        //            return $next($request);
        //        }

        //        /** @var User $user */
        //        $user = Auth::user(); TODO Consider implementation of 2FA
        //
        //        $userHasTwoFactorsEmpty = is_null($user?->two_factor_secret);
        //        $companyRequiresTwoFactor = (bool) $user?->company?->require_2fa;
        //        if ($userHasTwoFactorsEmpty && $companyRequiresTwoFactor && Auth::check()) {
        //            return redirect()->route('profile.show');
        //        }
        return $next($request);
    }
}
