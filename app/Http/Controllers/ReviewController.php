<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('customer')->orderBy('id', 'desc')->get();
        return view('admin.feedback.index', compact('feedbacks'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);
        // $checkReviewExits = Feedback::where([
        //     'product_id' => $request->product_id,
        //     'customer_id' => $request->customer_id
        // ])->first();
        // if ($checkReviewExits) {
        //     $notification = array(
        //         "message" => "Phẩn hồi này đã tồn tại",
        //         "alert-type" => "error",
        //     );
        //     return redirect()->back()->with($notification);
        // }
        $feedback = new Feedback();
        // $feedback->product_id = $request->product_id;
        $feedback->customer_id = $request->customer_id;
        $feedback->rating = $request->rating;
        $feedback->comment = $request->comment;
        $feedback->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $feedback->save();

        Customer::where('id', $request->customer_id)->update([
            'isComment' => 0
        ]);
    


        $notification = array(
            "message" => "Đánh giá thực phẩm thành công",
            "alert-type" => "success",
        );
        return redirect()->back()->with($notification);
    }

    public function destroy(string $id)
    {

        $Feedback = Feedback::findOrFail($id);
        $Feedback->delete();
        return response(['status' => 'success', 'message' => 'Đã xoá thành công!']);
    }
}
