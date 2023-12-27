<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {


        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity = $request->quantity;

        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->total_used = 0;
        $coupon->status = $request->status;
        $coupon->save();



        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'code' => ['required', 'max:200'],
            'quantity' => ['required', 'integer'],

            'start_date' => ['required'],
            'end_date' => ['required'],
            'discount_type' => ['required', 'max:200'],
            'discount' => ['required', 'integer'],
            'status' => ['required', 'integer']

        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity = $request->quantity;

        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;
        $coupon->save();

        $notification = array(
            "message" => "Updated coupon successfully",
            "alert-type" => "success",
        );

        return redirect()->route('coupons.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->delete();
    }

    public function changeStatus(Request $request)
    {
        $coupon  = Coupon::findOrFail($request->id);
        $coupon->status = $request->status;
        $coupon->save();
        return response(['message' => 'Status has been updated!']);
    }
}
