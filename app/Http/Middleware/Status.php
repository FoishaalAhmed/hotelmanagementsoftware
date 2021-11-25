<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Status
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {

            if (auth()->user()->status == 1) {

                return $next($request);

            } else {

                $message = "<center> <b> You are account is inactive. Please contact with Admin to active it. <b></center>";

                exit($message);
            }

        } else {

            return redirect('/');
        }
    }
}
