<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index($productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        $variantItem  = ProductVariantItem::where('product_variant_id', request()->variantId)->get();
        return view('admin.products.product-variant-item.index', compact('product', 'variant', 'variantItem'));
    }
    public function create(string $productId, string $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('admin.products.product-variant-item.create', compact('variant', 'product'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],

        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;

        $variantItem->save();
        $notification = array(
            "message" => "Thêm biến thể chi tiết thành công",
            "alert-type" => "success",
        );

        return redirect()->back()->with($notification);
    }
    public function edit(string $variantItemId)
    {
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        return view('admin.products.product-variant-item.edit', compact('variantItem'));
    }
    public function update(Request $request, string $variantItemId)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],

        ]);

        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;

        $variantItem->save();


        $notification = array(
            "message" => "Cập nhật biến thể chi tiết thành công",
            "alert-type" => "success",
        );
        return redirect()->route(
            'products-variant-item.index',
            ['productId' => $variantItem->productVariant->product_id, 'variantId' => $variantItem->product_variant_id]
        )->with($notification);
    }
    public function destroy(string $variantItemId)
    {
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        $variantItem->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
