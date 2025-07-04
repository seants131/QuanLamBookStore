<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) { // Kiểm tra xem người dùng có phải admin không
            return $next($request);
        }

        return redirect('/admin/sign-in'); // Nếu không phải admin, chuyển về trang đăng nhập
    }
}

class IsUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'khach') { // Kiểm tra xem người dùng có phải là khách hàng không
            return $next($request);
        }

        return redirect('/sign-in'); // Nếu không phải khách hàng, chuyển về trang đăng nhập
    }
}