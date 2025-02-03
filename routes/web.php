<?php

use Illuminate\Support\Facades\Route;
use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/api-keys', function () {
        return view('api-keys', [
            'tokens' => Auth::user()->apiTokens
        ]);
    })->name('api-keys');

    Route::post('/api-keys', function (Request $request) {
        $request->validate(['name' => 'required|string|max:255']);

        $token = Str::random(60);

        Auth::user()->apiTokens()->create([
            'name' => $request->name,
            'token' => hash('sha256', $token),
        ]);

        return back()->with('token', $token);
    });

    Route::delete('/api-keys/{token}', function (ApiToken $token) {
        $token->delete();
        return back();
    });
});