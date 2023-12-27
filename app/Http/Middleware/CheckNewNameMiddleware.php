<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNewNameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasCookie('customer_name')) {
            $tableId = $_GET['tableId'];
            $tableNo = $_GET['tableNo'];
            return redirect()->route('form_infor_user', 'tableId=' . $tableId . '&tableNo=' . $tableNo)->with('error', 'Please enter a name to view the menu');
        }
        return $next($request);
    }
}
