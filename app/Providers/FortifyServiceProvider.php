<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        // Redirect setelah login berdasarkan role
        Fortify::loginResponse(function (Request $request) {
            if (auth()->user()->role === 'admin') {
                return redirect('/dashboard');
            }
            return redirect('/');
        });
    }
} 