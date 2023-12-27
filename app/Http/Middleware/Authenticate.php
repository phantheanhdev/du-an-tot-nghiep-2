<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        // if (!$request->expectsJson()) {
        //     return route('login');
        // }
        if (!Auth::guard('web')->check()) {
            return route('login');
        }
        // if (!$request->expectsJson()) {
        //     $table_id = $_GET['tableId'];
        //     $table_no = $_GET['tableNo'];
        //     return route('form_infor_user', [
        //         'tableNo' => $table_no,
        //         'tableId' => $table_id
        //     ]);
        // }



        if (Auth::guard('customer')->check()) {
            $table_id = $_GET['tableId'];
            $table_no = $_GET['tableNo'];
            return redirect()->route('order.menu', [
                'tableNo' => $table_no,
                'tableId' => $table_id
            ]);
        }

        // if ($request->is('order/menu') || $request->is('order/menu/*')) {
        //     $table_id = $_GET['tableId'];
        //     $table_no = $_GET['tableNo'];
        //     return route('form_infor_user', [
        //         'tableNo' => $table_no,
        //         'tableId' => $table_id
        //     ]);
        // }
    }
}
