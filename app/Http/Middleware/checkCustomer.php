<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('customer')->check()) {
            $table_id = $_GET['tableId'];
            $table_no = $_GET['tableNo'];
            return route('form_infor_user', [
                'tableNo' => $table_no,
                'tableId' => $table_id
            ]);
        }
    
        return $next($request);
    }
}
