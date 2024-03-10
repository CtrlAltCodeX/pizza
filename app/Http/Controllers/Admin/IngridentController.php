<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\IngredientsMaster;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IngridentController extends Controller
{
    public function index(Request $request){
        $data = IngredientsMaster::all();
        $category = Category::where('status','<>','2')->orderBy('id','DESC')->get();

        return view('admin/ingrdients/ingredient')
            ->with('ingre', $data)
            ->with('category', $category);
    }

    public function ingredientTable(Request $request){
        $data = IngredientsMaster::all();
        $category = Category::where('status','<>','2')->orderBy('id','DESC')->get();
        if($request->ajax()){

            $dataArray = [];
            foreach($data as $item) {
                $categoryName = '';
                foreach($category as $cat) {
                    if($item['used_in'] == $cat['id']) {
                        $categoryName = $cat['name'];
                        break;
                    }
                }
                $dataArray[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'based_on' => $item->based_on,
                    'used_in' => $categoryName,
                    'price' => $item->price,
                    'image' => '<img class="rounded-circle" width="35" src="'.asset(''.$item->img).'" alt="">',
                    'action' => '<ul class="list-inline mb-0 d-flex justify-content-center align-middle p-2">
                        <li class="list-inline-item">
                            <a class="text-warning editItem" href="javascript:void(0)" id="'.$item->id.'">
                                <i class="fas fa-pencil-alt p-2 bg-soft-warning border border-warning rounded-circle"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-danger deleteItem" href="javascript:void(0)" id="'.$item->id.'">
                                <i class="fa fa-trash p-2 bg-soft-danger border border-danger rounded-circle" data-id="1"></i>
                            </a>
                        </li>
                    </ul>'
                ];
            }


            return DataTables::of($dataArray)
                ->addIndexColumn()
                ->rawColumns(['action', 'image'])
                ->make('true');



            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('column_name', function ($row) {
                    return $row->column_name;
                })
//                ->addColumn('status',function ($row){
//                    if($row->status == '1'){
//                        $checked = 'checked';
//                    }else{
//                        $checked = '';
//                    }
//                    $status = '<div class="form-check form-switch form-switch-md d-flex justify-content-center p-1" dir="ltr">
//                                    <input type="checkbox" onclick="status(this)" class="form-check-input statusBtn s'.$row->id.'" id="'.$row->id.'" '.$checked.'>
//                                </div>';
//                    return $status;
//                })
                ->addColumn('image',function ($row){
                    $status = '<img class="rounded-circle" width="35" src="'.asset('admin/images/category/'.$row->img).'" alt="">';
                    return $status;
                })
                ->addColumn('action',function ($row){
                    $action = '<ul class="list-inline mb-0 d-flex justify-content-center align-middle p-2">
                                    <li class="list-inline-item">
                                        <a class="text-warning editItem" href="javascript:void(0)" id="'.$row->id.'">
                                            <i class="fas fa-pencil-alt p-2 bg-soft-warning border border-warning rounded-circle"></i>
                                        </a>

                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-danger deleteItem" href="javascript:void(0)" id="'.$row->id.'">
                                            <i class="fa fa-trash p-2 bg-soft-danger border border-danger rounded-circle" data-id="1"></i>
                                        </a>
                                    </li>
                                </ul>';
//                    <li class="list-inline-item">
//                                        <a class="text-success viewItem" href="javascript:void(0)" id="'.$row->id.'">
//                                            <i class="ri-eye-fill fs-16 p-2 bg-soft-success border border-success rounded-circle" data-id="1"></i>
//                                        </a>
//                                    </li>
                    return $action;
                })
                ->rawColumns(['status', 'action', 'image'])
                ->make('true');
        }
    }

    public function addIngredients(Request  $request){

        $image = $request->file('image');

        if($image){
            $filename = $image->getClientOriginalName();
            $request->file('image')->move(public_path('admin/images/ingredients'), $filename);
        }

        $data = IngredientsMaster::create([
            'based_on' => $request->based_on,
            'used_in' => $request->used_in,
            'name' => isset($request->name) ? $request->name : '' ,
            'price' => $request->price,
            'status' => true,
            'img' => isset($filename) ? 'admin/images/ingredients/' . $filename : '',
        ]);

        if($data){
            return response()->json([
                'status' => 1,
                'message' => 'Successfully added'
            ]);
        }
    }
}
