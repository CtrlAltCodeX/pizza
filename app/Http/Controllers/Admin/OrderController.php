<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data = Order::with('order_details')->orderBy('id', 'ASC')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_id', function ($row) {
                    return $row->order_id;
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->addColumn('payment_method', function ($row) {
                    return $row->payment_method;
                })
                ->addColumn('total', function ($row) {
                    return $row->total;
                })
                ->addColumn('action', function ($row) {
                    $urlShow = route('admin.showData', $row->id);
                    $btn = '<a href="' . $urlShow . '" class="edit text-info" title="See details"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    $btn .= " ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.orders.index');
    }


    public function showData($id)
    {
        $data = OrderDetails::with(['users', 'item_master', 'category'])
            ->where('orderMaster_id', $id)
            ->orderBy('id', 'ASC')
            ->get();

        $order = Order::find($id);

        return view('admin.orders.show', compact('data', 'order', 'id'));
    }

    public function updateStatus($id)
    {
        $order = Order::find($id);

        $order->update([
            'status' => request()->status
        ]);

        return redirect()->back();
    }
}
