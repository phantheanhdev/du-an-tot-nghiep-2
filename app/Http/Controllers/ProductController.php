<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\FlashSaleItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name as category_name')->orderBy('id' , 'desc')
            ->get();
        return view('admin.products.index', compact('product'));
    }


    public function add(ProductRequest $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->post();
            unset($params['_token']);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('public/images');
                $request->image = $imagePath;
            }

            $product = new Product;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->status = $request->status;

            $product->image = $request->image;

            $product->save();


            if ($product->save()) {
                $notification = array(
                    "message" => "Thêm thực phẩm thành công",
                    "alert-type" => "success",
                );
                return redirect()->route('product.index')->with($notification);
            }
        }
        $category = Category::all();
        return view('admin.products.add', compact('category'));
    }

    public function edit(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->isMethod('post')) {
            $params = $request->post();
            unset($params['_token']);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete the old image
                Storage::delete('public/' . $product->image);

                // Upload the new image and get its path
                $imagePath = $request->file('image')->store('public/images');
                $product->image = $imagePath;
            } else {
                $imagePath = $product->image;
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->status = $request->status;

            $product->image = $imagePath;
            $product->save();

            $notification = array(
                "message" => "Cập nhật thực phẩm thành công",
                "alert-type" => "success",
            );
            return redirect()->route('product.index')->with($notification);
        }
        $category = Category::all();
        return view('admin.products.edit', compact('product', 'category'));
    }

    public function delete($id)
    {
        if ($id) {
            $product = Product::where('id', $id);

            $variants = ProductVariant::where('product_id', $id)->get();
            foreach ($variants as $variant) {
                $variant->productVariantItems()->delete();
                $variant->delete();
            }
            $flashSaleItem  = FlashSaleItem::where('product_id', $id);
            $flashSaleItem->delete();

            $deleted = $product->forceDelete();
            if ($deleted) {
                $notification = array(
                    "message" => "Xóa thực phẩm thành công",
                    "alert-type" => "success",
                );
            } else {
                $notification = array(
                    "message" => "Xóa sản thực phẩm thất bại",
                    "alert-type" => "error",
                );
            }
        }
        return redirect()->back()->with($notification);
    }


    public function show_product_in_category($id){
        $category_id = $id;
        $category = Category::where('id' , $category_id)->first();
        $products = Product::where('category_id' , $category_id)->orderBy('id' , 'desc')->get();
        return view('admin.categories.showproduct' , compact('products' , 'category'));
    }
}
