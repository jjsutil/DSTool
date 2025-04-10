<?php

use Illuminate\Support\Facades\Route;
use Laravel\Horizon\Horizon;

require __DIR__.'/auth.php';

Route::get('/admin', fn () => redirect('/'));
Route::get('/dashboard', fn () => redirect('/'));
Route::get('/dashboard', fn () => redirect('/'))->name('dashboard');

//Horizon::auth(function ($request) {
//    // TODO: Lock this down (e.g. admin-only)
//    return true;
//});

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
