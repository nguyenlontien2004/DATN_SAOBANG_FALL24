<?php

namespace App\Http\Middleware;

use App\Models\NguoiDung;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::user();

        /**
         * @var NguoiDung $admin
         */

        return $admin->admin() ? $next($request) : abort(403);
    }
}
