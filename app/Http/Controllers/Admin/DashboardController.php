<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function users()
    {
        $data = User::orderBy('id', 'desc')->where('staff', 1)->get();

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone;
                })
                ->make(true);
        }

        return view('admin.index');
    }

    public function registration()
    {
        return view('admin.registration');
    }

    public function registrationSubmit()
    {
        $data = User::create(request()->all());

        return redirect()->route('admin.users');
    }
}
