<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {

        $order = $this->order->where('status', 0)->orderBy('id', 'desc')->get();
        $orders = $this->order->where('status',5)->orderBy('id', 'desc')->get();
        $cancel = $this->order->where('status',2)->orderBy('id', 'desc')->get();
        return view('admin.orders.index', [
            'order' => $order,
            'orders' => $orders,
            'cancel' => $cancel
        ])->with('i', (request()->input('page', 1) - 1) * 10);
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
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $orders = Order::findOrFail($request->id);
        $orders->delete();
    }

    public function updateOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        $order->save();
        return response(['message' => 'Trạng thái đã được cập nhật']);
    }

    public function viewInvoice(string $id)
    {
        $order  = Order::findOrFail($id);
        $todayDate = Carbon::now('Asia/Ho_Chi_Minh');
        $bill = OrderDetail::where('order_id', $id)->get();
        return view('admin.invoice.generate_invoice', [
            'order' => $order,
            'bill' => $bill,
            'todayDate' => $todayDate

        ]);


    }

    public function genarateInvoice(string $id)
    {
        $order = Order::findOrFail($id);
        $todayDate = Carbon::now('Asia/Ho_Chi_Minh');
        $bill = OrderDetail::where('order_id', $id)->get();
        $pdf = Pdf::loadView('admin.invoice.print_invoice', [
            'order' => $order,
            'bill' => $bill,
            'todayDate' => $todayDate
        ]);
        return $pdf->download('invoice-' . $order->id . '-' . $todayDate . '.pdf');
    }

    public function print_order(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        $order->update([
            'status' => 5
        ]);
        if (isset($order->customer_id)) {
            Customer::where('id', $order->customer_id)->update([
                'isComment' => 1
            ]);
        }
        $orderDetail = OrderDetail::where('order_id' , $order->id)->get();
        foreach($orderDetail as $item){
            $product = Product::where('id' , $item->product_id)->first();
            Product::where('id' , $item->product_id)->update([
                'purchases' => $product->purchases + $item->quantity
            ]);

        }


        $todayDate = Carbon::now('Asia/Ho_Chi_Minh');
        $bill = OrderDetail::where('order_id', $id)->get();
        $pdf = Pdf::loadView('admin.invoice.print_invoice', [
            'order' => $order,
            'bill' => $bill,
            'todayDate' => $todayDate
        ]);
         return $pdf->stream();
         
    }

    public function billOrder(string $id){
        $order = Order::findOrFail($id);
        $bill = OrderDetail::where('order_id', $id)->get();
        $pdf = Pdf::loadView('admin.orders.bill-order', [
            'order' => $order,
            'bill' => $bill,

        ]);
         return $pdf->stream();
    }
    public function getOrder()
    {

        $orders = Order::with(['orderDetails.product'])
            ->whereIn('status', [0, 1, 3, 4])
            ->orderByDesc('created_at')
            ->get();

        return $orders;
    }
}
