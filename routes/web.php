<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('filament::dashboard');
})->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


///** Email verification */
//
//Route::get('/verify-email/{id}/{hash}', function (Request $request) {
//    $user = User::findOrFail($request->id);
//
//    if (! hash_equals((string) $request->hash, sha1($user->email))) {
//        abort(403);
//    }
//
//    if (!$user->hasVerifiedEmail()) {
//        $user->markEmailAsVerified();
//        event(new Verified($user));
//    }
//
//    return redirect()->route('dashboard')->with('verified', 1);
//})->middleware(['auth', 'signed'])->name('verification.verify');
