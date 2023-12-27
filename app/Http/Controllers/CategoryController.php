<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.categories.index', compact('category'));
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function store(CategoryRequest $request)
    {
            if ($request->isMethod('post')) {
            $params = $request->post();
            unset($params['_token']);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Upload the file and get its path
                $imagePath = $request->file('image')->store('public/images');
                $request->image = $imagePath;
            }

            // Create a new category instance
            $category = new Category;
            $category->category_name = $request->category_name;
            $category->note = $request->note;
            $category->status = $request->status;
            $category->image = $request->image;
            $category->save();

            if ($category->save()) {
                $notification = array(
                    "message" => "Thêm danh mục thành công",
                    "alert-type" => "success",
                );
                return redirect()->route('category.index')->with($notification);
            }
        }

        return view('admin.categories.create');
    }
    public function edit(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($request->isMethod('post')) {
            $params = $request->post();
            unset($params['_token']);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete the old image
                Storage::delete('public/' . $category->image);

                // Upload the new image and get its path
                $imagePath = $request->file('image')->store('public/images');
                $category->image = $imagePath;
            } else {
                $imagePath = $category->image;
            }

            $category->category_name = $request->category_name;
            $category->note = $request->note;
            $category->status = $request->status;
            $category->image = $imagePath;
            $category->save();

            $notification = array(
                "message" => "Cập nhật danh mục thành công",
                "alert-type" => "success",
            );
            return redirect()->route('category.index')->with($notification);
        }

        return view('admin.categories.edit', compact('category'));
    }


    public function delete($id)
    {
        if($id){
            $category = Category::findOrFail($id);
            if ($category->products->isEmpty()) {
                $notification = array(
                            "message"=> "Xóa danh mục thành công",
                             "alert-type" =>"success",
                        );
                $category->delete();
                return redirect()->back()->with($notification);
            } else {
                $notification = array(
                            "message"=> "Không thể xóa danh mục với chứa sản phẩm",
                            "alert-type" =>"error",
                        );
                return redirect()->back()->with($notification);
            }
        }
        return;
    }
}
