<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::findOrFail($request->product);
        $productVariant = ProductVariant::where('product_id', $request->product)->get();
        return view('admin.products.product-variant.index', compact('product', 'productVariant'));
    }
    public function create()
    {
        return view('admin.products.product-variant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => ['integer', 'required'],
            'name' => ['required', 'max:200'],

        ]);
        $varinat = new ProductVariant();
        $varinat->product_id = $request->product;
        $varinat->name = $request->name;
        if (isset($request->multi_choice)) {
            $varinat->multi_choice = $request->multi_choice;
        } else {
            $varinat->multi_choice = 0;
        }
        $varinat->save();

        $notification = array(
            "message" => "Thêm biến thể thành công",
            "alert-type" => "success",
        );

        return redirect()->back()->with($notification);
    }
    public function edit(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        return view('admin.products.product-variant.edit', compact('variant'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],

        ]);

        $varinat = ProductVariant::findOrFail($id);
        $varinat->name = $request->name;
        if (isset($request->multi_choice)) {
            $varinat->multi_choice = $request->multi_choice;
        } else {
            $varinat->multi_choice = 0;
        }
        $varinat->save();

        $notification = array(
            "message" => "Cập nhật biến thể thành công",
            "alert-type" => "success",
        );

        return redirect()->route('products-variant.index', ['product' => $varinat->product_id])->with($notification);
    }
    public function destroy(string $id)
    {
        $varinat = ProductVariant::findOrFail($id);
        $variantItemCheck = ProductVariantItem::where('product_variant_id', $varinat->id)->count();
        if ($variantItemCheck > 0) {
            return response(['status' => 'error', 'message' => 'This variant contain variant items in it delete the variant items first for delete this variant!']);
        }
        $varinat->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
