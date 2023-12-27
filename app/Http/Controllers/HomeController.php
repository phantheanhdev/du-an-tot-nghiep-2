<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function form_infor_user()
    {
        $table_id = $_GET['tableId'];
        $table_no = $_GET['tableNo'];
        return view('user.form_infor_user', [
            'table_id' => $table_id,
            'table_no' => $table_no
        ]);
    }

    public function loginUser(Request $request)
    {


        $request->validate([
            'phone' => 'required|regex:/^[0-9]+$/|min:10|max:10',
        ], [
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại chỉ được chứa ký tự số.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 số.',
            'phone.max' => 'Số điện thoại không được vượt quá 10 số.',
        ]);
        $phone = $request->phone;
        $password = $request->password;

        $customer = Customer::where('phone', $phone)->exists();
        if ($customer) {
            $credential = [
                'phone' => $phone,
                'password' => $password
            ];

            if (Auth::guard('customer')->attempt($credential)) {
                return redirect()->route('order.menu', [
                    'tableNo' => $request->tableNo,
                    'tableId' => $request->tableId
                ]);
            }
        } else {
            $customer = Customer::create([
                'phone' => $phone,
                'password' => bcrypt($password),

            ]);
            Auth::guard('customer')->login($customer);
            return redirect()->route('order.menu', [
                'tableNo' => $request->tableNo,
                'tableId' => $request->tableId
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        $table_id = $_GET['tableId'];
        $table_no = $_GET['tableNo'];
        return redirect('/foodie?tableNo=' . $table_no . '&tableId=' . $table_id);
    }
}
