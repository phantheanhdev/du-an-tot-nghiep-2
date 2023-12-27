<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Customer extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function redirectTo(Request $request): ?string
    {
        $tableId = $_GET['tableId'];
        $tableNo = $_GET['tableNo'];
        return $request->expectsJson() ? null : route('form_infor_user', [
            'tableNo' => $tableNo,
            'tableId' => $tableId
        ]);


    }
}
