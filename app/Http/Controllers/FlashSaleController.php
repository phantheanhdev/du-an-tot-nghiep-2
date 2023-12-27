<?php

namespace App\Http\Controllers;


use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {

        $products = Product::where('status', 'active')->orderBy('id', 'desc')->get();
        $flashSaleItem = FlashSaleItem::with('product')->orderBy('id', 'desc')->get();
        return view('admin.flash-sale.index', compact('products', 'flashSaleItem'));
    }



    public function addProduct(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'unique:flash_sale_items,product_id'],
            'discount_rate' => ['required', 'numeric', 'min:5', 'max:99'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ], [
            'product.unique' => 'Sản phẩm hiện đang có chương trình flash sale!'
        ]);


        foreach ($request->product_id as $item) {
            Product::where('id', $item)->update([
                'flashSale' => 1
            ]);
        }
        foreach ($request->product_id as $item) {
            $flashSaleItem = new FlashSaleItem();
            $flashSaleItem->product_id = $item;
            $flashSaleItem->discount_rate = $request->discount_rate;
            $flashSaleItem->start_date = $request->start_date;
            $flashSaleItem->end_date = $request->end_date;
            $flashSaleItem->status = 1;
            $flashSaleItem->save();
        }



        return response(['status' => 'success', 'message' => 'Sản phẩm được áp dụng thành công!']);
    }

    public function changeStatus(Request $request)
    {
        $flashSaleItem  = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();
        return response(['message' => 'Trạng thái đã được cập nhật!']);
    }
    public function destory(string $id)
    {

        $flashSaleItem = FlashSaleItem::findOrFail($id);
        Product::where('id', $flashSaleItem->product_id)->update([
            'flashSale' => 0
        ]);
        if ($flashSaleItem->product_id) {
            $cart = session()->get('cart');
            if (isset($cart[$flashSaleItem->product_id])) {
                unset($cart[$flashSaleItem->product_id]);
                session()->put('cart', $cart);
            }
        }
        $flashSaleItem->delete();
        return response(['status' => 'success', 'message' => 'Đã xoá thành công!']);
    }

    public function deleteSelectAll(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            foreach ($list_check as $id) {
                $flashSaleItem = FlashSaleItem::findOrFail($id);
                Product::where('id', $flashSaleItem->product_id)->update([
                    'flashSale' => 0
                ]);
                if ($flashSaleItem->product_id) {
                    $cart = session()->get('cart');
                    if (isset($cart[$flashSaleItem->product_id])) {
                        unset($cart[$flashSaleItem->product_id]);
                        session()->put('cart', $cart);
                    }
                }
                $flashSaleItem->delete();
            }
            return redirect()->back()->with(['message' => 'Đã xoá thành công !']);
        } else {
            return redirect()->back()->with(['message' => 'Chưa có phiên bản nào được chọn']);
        }
    }
}
