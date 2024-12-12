<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.form');
    }
}
