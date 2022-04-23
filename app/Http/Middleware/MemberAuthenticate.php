<?php

namespace App\Http\Middleware;

use Closure;

class MemberAuthenticate {
    /**
     * @param $request
     * @param Closure $next
     * @return mixed|string
     */
    public function handle($request, Closure $next) {
        if (!auth('web')->check()) {
            return redirect()->route('get.home.index');
        }

        return $next($request);
    }
}

