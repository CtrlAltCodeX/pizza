<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ItemMaster;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Homepage
     */
    public function index()
    {
        $items = ItemMaster::where('category_master_id', 7)
            ->limit(6)
            ->get();

        // $groupedItems = ItemMaster::select('category_master_id')
        //     ->groupBy('category_master_id')
        //     ->get();
        // dd($groupedItems);
        return view('web.index', compact('items'));
    }
}
