<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ellenőrizze, hogy a felhasználó rendelkezik-e admin jogosultsággal
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Ha nincs admin jogosultság, visszadob a bejelentkezési oldalra vagy egyéb kezelés
        return redirect('/login')->with('error', 'Nincs jogosultságod ehhez a művelethez.');
    }
}
