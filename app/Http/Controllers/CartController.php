<?php

namespace App\Http\Controllers;

use CarbonCarbon;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        //
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(['cart' => $cart]);
        }
    }

    public function clean_session()
    {
        session(['cart' => []]);  // Set the 'cart' key to an empty array

        return response()->json(['cart' => []]);
    }
    public function addToCart($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // Sử dụng crc32 để tạo giá trị chỉ chứa chữ số từ mảng
        $itemHash = sprintf("%u", crc32(serialize($request->input('item', []))));

        $cartKey = $id . $itemHash;

        if (isset($cart[$cartKey])) {
            $newQuantity = $cart[$cartKey]['quantity'] + $request->input('quantity', 1);
            if ($newQuantity > 10) {
                return response()->json(['error' => 'Số lượng vượt quá giới hạn. Vui lòng gọi nhân viên.']);
            }
            $cart[$cartKey]['quantity'] = $newQuantity;
        } else {
            $quantity = $request->input('quantity', 1);
                if ($quantity > 10) {
                return response()->json(['error' => 'Số lượng vượt quá giới hạn. Vui lòng gọi nhân viên.']);
            }
            $cart[$cartKey] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $request->price,
                "item" => $request->input('item', []),
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['cart' => $cart]);
    }





    public function order(OrderRequest $request)
    {
        $order = new Order();
        $order->table_id = $request->table_id;
        $order->order_day = Carbon::now('Asia/Ho_Chi_Minh');
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $order->total_price = $request->total_price;
        $order->status = 0;
        $order->note = $request->note;
        $order->phone = $request->customer_phone;
        $order->customer_id = $request->customer_id;
        $order->save();

        Customer::where('id', $request->customer_id)->update([
            'isComment' => 1
        ]);

        $cart = session()->get('cart');

        foreach ($cart as $item) {
            $productOrder  = new OrderDetail();
            $productOrder->order_id = $order->id;
            $productOrder->product_id = $item['id'];
            $productOrder->quantity  = $item['quantity'];
            $productOrder->total_amount = $item['quantity'] * $item['price'];
            $productOrder->product_name = $item['name'];
            $productOrder->product_price = $item['price'];
            $productOrder->product_img = $item['image'];
            $productOrder->item = json_encode($item['item']);
            $productOrder->save();
        }
        if ($request->point && $request->point > 0) {
            $customer = Customer::where('phone', $request->customer_phone)->first();

            if ($customer) {
                $now = $customer->point;
                $newPoint = $now - $request->point;
                $customer->update(['point' => $newPoint]);
            }
        }


        session()->forget('cart');

        return redirect()->back()->with('success', 'Đặt món thành công');
    }
    public function getCart(Request $request)
    {
        $cart = session()->get('cart', []);
        return response()->json(['cart' => $cart]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }


    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code === null) {
            return response(['status' => 'error', 'message' => 'Coupon filed is required']);
        }
        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        if ($coupon === null) {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        } else if ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        } else if ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is expired']);
        } else if ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'you can not apply this coupon']);
        }

        if ($coupon->discount_type === 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        } else if ($coupon->discount_type === 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $subTotal = getTotalCart();
            if ($coupon['discount_type'] === 'amount') {
                if ($coupon['discount'] >= getTotalCart()) {
                    $total =  0;
                    return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
                } else {
                    $total = $subTotal - $coupon['discount'];
                    return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
                }
            } else if ($coupon['discount_type'] === 'percent') {
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        } else {
            $total = getTotalCart();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }

    public function cencelCoupon()
    {
        if (Session::has('coupon')) {
            session()->forget('coupon');
            $total = getTotalCart();
            return response(['status' => 'success', 'message' => 'Voucher canceled successfully!',  'cart_total' => $total, 'discount' => 0]);
        }
    }
}
