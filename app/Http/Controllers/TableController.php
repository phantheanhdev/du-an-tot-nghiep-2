<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Customer;
use App\Models\Table;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF;


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_table = Table::orderBy('id', 'desc')->get();

        return view('admin.table.index', ['all_table' => $all_table]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        $name = $request->input('name');
        $type = $request->input('type');
        $get_http_host = $_SERVER['HTTP_HOST'];

        $nameExists = Table::where('name', $name)->exists();

        if ($nameExists) {
            $notification = [
                'message' => 'Tên bàn đã tồn tại. Vui lòng chọn tên khác',
                'alert-type' => 'error',
            ];
            return redirect()->route('table.create')->withInput()->with($notification);
        }

        // Lấy id lớn nhất và tạo mới 1 id để gán vào link
        $id = Table::max('id');
        $new_id = $id + 1;

        $data = [
            'name' => $name,
            'type' => $type,
            'qr' => 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://' . $get_http_host . '/foodie?tableId=' . $new_id . '%26tableNo=' . $name
        ];

        try {
            Table::create($data);

            $notification = [
                'message' => 'Thêm bàn thành công',
                'alert-type' => 'success',
            ];

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message' => 'Thêm bàn thất bại',
                'alert-type' => 'failse',
            ];

            return redirect()->route('table.create')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {

        return view('admin.table.edit', ['table' => $table]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        $name = $request->input('name');
        $type = $request->input('type');
        $get_http_host = $_SERVER['HTTP_HOST'];

        $nameExists = Table::where('name', $name)
            ->where('id', '<>', $table->id)
            ->exists();

        if ($nameExists) {
            $notification = [
                'message' => 'Tên bàn đã tồn tại. Vui lòng chọn tên khác',
                'alert-type' => 'error',
            ];
            return redirect()->route('table.edit', $table->id)->withInput()->with($notification);
        }

        $data = [
            'name' => $name,
            'type' => $type,
            'qr' => 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://' . $get_http_host . '/foodie?tableId=' . $table->id . '%26tableNo=' . $name
        ];

        try {
            $table->update($data);

            $notification = [
                'message' => 'Đã sửa thông tin bàn thành công',
                'alert-type' => 'success',
            ];

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message' => 'Sửa thông tin bàn thất bại',
                'alert-type' => 'failse',
            ];

            return redirect()->route('table.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        try {
            $table->delete();

            $notification = array(
                "message" => "Xóa bàn thành công",
                "alert-type" => "success",
            );

            return redirect()->route('table.index')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                "message" => "Xóa bàn thất bại",
                "alert-type" => "failse",
            );

            return redirect()->route('table.index')->with($notification);
        }
    }

    public function download_qr_code(Request $request)
    {
        $id = $request->id;
        $table = Table::findOrFail($id);
        $name = $table->name;
        $get_http_host = $_SERVER['HTTP_HOST'];

        $filename = 'Foodie_QR.pdf';
        // $html = '<img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://' . $get_http_host . '/foodie?tableId=' . $table->id . '%26tableNo=' . $name . '" alt="" style="text-align: center"> 
        //     <h1 style="text-align: center">Bàn ' . $name . '</h1>
        // ';
        $html = ' <div >
        <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://' . $get_http_host . '/foodie?tableId=' . $table->id . '%26tableNo=' . $name . '" alt=""> 
        <h1>__________Bàn ' . $name . '__________</h1>
        </div>
    ';


        $pdf = new TCPDF;

        $pdf::SetTitle('Foodie');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
    }

    // trang đầu tiên khi chuyển hướng về admin
    public function restaurant_manager()
    {
        $tables = Table::with('orders')->get();
        return view('admin.restaurant-manager', ['tables' => $tables]);
    }

    // trang chi tiết order nhận của từng bàn
    public function order_of_table($id)
    {
        $table = Table::findOrFail($id);

        $orders = Order::where('table_id', $id)
            ->whereIn('status', [0, 1])
            ->get();
        foreach ($orders as $order) {
            $order->orderDetails = OrderDetail::where('order_id', $order->id)->get();

            foreach ($order->orderDetails as $orderDetail) {
                $orderDetail->product = Product::find($orderDetail->product_id);
            }
        }

        return view('admin.order-of-table', ['table' => $table, 'orders' => $orders]);
    }

    public function getOrderNew($id)
    {
        // Assuming Table and Order models have relationships defined
        $table = Table::findOrFail($id);

        // Eager loading relationships to optimize queries
        $orders = Order::with(['orderDetails.product'])
            ->where('table_id', $id)
            ->whereIn('status', [0, 1, 3, 4])
            ->orderByDesc('created_at')
            ->get();

        return $orders;
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $newStatus = $request->input('status');

        // Kiểm tra xem trạng thái mới hợp lệ hay không
        if (!in_array($newStatus, [0, 1, 2, 3, 4, 5])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }
        $phone = $request->input('phone');
        $total = $request->input('total');

        if ($newStatus == 5) {
            $customer = Customer::where('phone', $phone)->first();

            if ($customer) {
                $points = ceil($total * 0.03);
                $customer->point += $points;
                $customer->save();
            }
            $order->status = $newStatus;
            $order->save();
            return redirect('print_order/' . $id);
            // return redirect()->route('print_order', ['id' => $id])->with('open_new_tab', true);
        }

        $order->status = $newStatus;
        $order->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}