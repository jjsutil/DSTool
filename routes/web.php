<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use App\Models\User;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

/** Email verification */

Route::get('/verify-email/{id}/{hash}', function (Request $request) {
    $user = User::findOrFail($request->id);

    if (! hash_equals((string) $request->hash, sha1($user->email))) {
        abort(403);
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    return redirect()->route('dashboard')->with('verified', 1);
})->middleware(['auth', 'signed'])->name('verification.verify');
