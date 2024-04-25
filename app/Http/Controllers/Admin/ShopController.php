<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shop = Shop::all();

        if ($request->ajax()) {
            return DataTables::of($shop)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="list-inline mb-0 d-flex justify-content-center align-middle p-2">
                    <li class="list-inline-item">
                        <a class="text-warning editItem" data-bs-toggle="modal" data-bs-target="#UpdateShop" href="javascript:void(0)" data-id="' . $row->id . '">
                            <i class="fas fa-pencil-alt p-2 bg-soft-warning border border-warning rounded-circle"></i>
                        </a>
                        <a class="text-warning deleteItem" href="javascript:void(0)" data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt p-2 bg-soft-warning border border-warning rounded-circle"></i>
                        </a>
                    </li>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.shop.index');
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
        Shop::create([
            'name' => request()->name,
            'status' => request()->status,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Successfully Created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shop = Shop::find($id);

        return response()->json([
            'status' => 1,
            'data' => $shop
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shop = Shop::find($id);

        $shop->update([
            'name' => request()->name,
            'status' => request()->status,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shop = Shop::find($id);

        $shop->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Successfully deleted'
        ]);
    }
}
