<?php

declare(strict_types=1);

namespace App\Http\Middleware;

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
        if (is_null(Auth::user()) || App::environment(['local', 'development'])) {
            return $next($request);
        }
        /** @phpstan-ignore-next-line  */
        $userHasTwoFactorsEmpty = is_null(Auth::user()?->two_factor_secret);
        /** @phpstan-ignore-next-line  */
        $companyRequiresTwoFactor = (bool)Auth::user()?->company?->require_2fa;
        if ($userHasTwoFactorsEmpty === true && $companyRequiresTwoFactor === true && Auth::check()) {
            return redirect('user/profile');
        }
        return $next($request);
    }
}
