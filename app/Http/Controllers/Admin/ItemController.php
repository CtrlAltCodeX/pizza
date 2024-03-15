<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\IngredientsMaster;
use App\Models\ItemMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        //        $data = ItemMaster::where('status','<>','2')->orderBy('id','DESC')->get();
        $data2 = Category::where('status', '1')->get();
        $all = [];
        foreach ($data2 as $item => $value) {

            if (isset($value['id'])) {
                $all[$value->name]['cheese'] = IngredientsMaster::where('used_in', $value->id)->where('based_on', 'cheese')->get()->toArray();
                $all[$value->name]['sauce'] = IngredientsMaster::where('used_in', $value->id)->where('based_on', 'sauce')->get()->toArray();
                $all[$value->name]['meat'] = IngredientsMaster::where('used_in', $value->id)->where('based_on', 'meat')->get()->toArray();
                $all[$value->name]['veggies'] = IngredientsMaster::where('used_in', $value->id)->where('based_on', 'veggies')->get()->toArray();
                $all[$value->name]['extraSauce'] = IngredientsMaster::where('used_in', $value->id)->where('based_on', 'extra-sauce')->get()->toArray();
                $all[$value->name]['extra'] = IngredientsMaster::where('used_in', $value->id)->where('based_on', 'extra')->get()->toArray();
            }
        }
        //Fetching Ingredients for pizza and pasta
        //        $cheese = IngredientsMaster::where('used_in', )->where('based_on', 'cheese')->get();
        //        $sauce = IngredientsMaster::where('used_in', )->where('based_on', 'sauce')->get();
        //        $meat = IngredientsMaster::where('used_in', )->where('based_on', 'meat')->get();
        //        $veggies = IngredientsMaster::where('used_in', )->where('based_on', 'veggies')->get();
        //        $extraSauce = IngredientsMaster::where('used_in', )->where('based_on', 'extra-sauce')->get();

        //dd($all);
        return view('admin.product.product', $all)
            ->with('category', $data2);
        //            ->with('cheese', $cheese)
        //            ->with('sauce', $sauce)
        //            ->with('meat', $meat)
        //            ->with('veggies', $veggies)
        //            ->with('extraSauce', $extraSauce);
    }

    public function itemsTable(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::all();
            $categoryMap = [];
            foreach ($category as $cat) {
                $categoryMap[$cat->id] = $cat->name;
            }

            $data = ItemMaster::where('status', '<>', '2')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('masterCategoryName', function ($row) use ($categoryMap) {
                    $categoryName = $categoryMap[$row->category_master_id] ?? '--';
                    return $categoryName;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                //                ->addColumn('description', function ($row){
                //                    return $row->description;
                //                })

                ->addColumn('price', function ($row) {
                    $pricesFromString = explode(', ', $row->price);
                    $html = '';
                    // HTML to display the array of prices from string
                    $html .= '<ul>';
                    foreach ($pricesFromString as $price) {
                        $html .= '<li>' . $price . '</li>';
                    }
                    $html .= '</ul>';

                    return $html;
                })
                ->addColumn('image', function ($row) {
                    $status = '<img class="rounded-circle" width="35" src="' . asset('admin/images/items/' . $row->img) . '" alt="">';
                    return $status;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    }
                    $status = '<div class="form-check form-switch form-switch-md d-flex justify-content-center p-1" dir="ltr">
                                    <input type="checkbox" onclick="status(this)" class="form-check-input statusBtn s' . $row->id . '" id="' . $row->id . '" ' . $checked . '>
                                </div>';
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $action = '<ul class="list-inline mb-0 d-flex justify-content-center align-middle p-2">
                                    <li class="list-inline-item">
                                        <a class="text-warning editItem" href="' . route('admin.getItemForUpdate', ['id' => $row->id]) . '">
                                            <i class="fas fa-pencil-alt p-2 bg-soft-warning border border-warning rounded-circle"></i>
                                        </a>

                                    </li>
                                </ul>';
                    //                                    <li class="list-inline-item">
                    //                                        <a class="text-danger deleteItem" href="javascript:void(0)" id="'.$row->id.'">
                    //                                            <i class="fa fa-trash p-2 bg-soft-danger border border-danger rounded-circle" data-id="1"></i>
                    //                                        </a>
                    //                                    </li>
                    //                    <li class="list-inline-item">
                    //                                        <a class="text-success viewItem" href="javascript:void(0)" id="'.$row->id.'">
                    //                                            <i class="ri-eye-fill fs-16 p-2 bg-soft-success border border-success rounded-circle" data-id="1"></i>
                    //                                        </a>
                    //                                    </li>
                    return $action;
                })
                ->rawColumns(['masterCategoryName', 'name', 'price', 'image', 'status', 'action'])
                ->removeColumn()
                ->make('true');
        }
    }

    public function addNewItem(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'priceSM' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'nullable',
            //            'veggies' => 'required',
            //            'meat' => 'required',
            //            'sauces' => 'required',
            'calories' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->first()
            ]);
        }

        if ($request->file('image')) {

            $image = $request->file('image');

            $filename = $image->getClientOriginalName();
            $request->file('image')->move(public_path('admin/images/items'), $filename);
        }


        $pricesConcatenated = implode(", ", [
            isset($request->priceSM) ? $request->priceSM : '',
            isset($request->priceM) ?  $request->priceM : '',
            isset($request->priceL) ?  $request->priceL : '',
            isset($request->priceXL) ?  $request->priceXL : ''
        ]);

        if (isset($request->category_type) && $request->category_type == 'PizzasPastas') {
            $add_on_toppings = isset($request->add_on_toppings) && !empty($request->add_on_toppings) ? implode(", ", $request->add_on_toppings) : "";
            $sauce = !empty($request->sauce) ? implode(", ", $request->sauce) : null;
            $cheese = !empty($request->cheese) ? implode(", ", $request->cheese) : null;
            $veggies = !empty($request->veggies) ? implode(", ", $request->veggies) : null;
            $meat = !empty($request->meat) ? implode(", ", $request->meat) : null;
            $extra = !empty($request->extra) ? implode(", ", $request->extra) : null;
            $size = isset($request->size) ? $request->size : null;
        } else if (isset($request->category_type) && $request->category_type == 'Sandwiches') {
            $add_on_toppings = isset($request->sandwich_add_on_toppings) && !empty($request->sandwich_add_on_toppings) ? implode(", ", $request->sandwich_add_on_toppings) : "";
            $sauce = !empty($request->sandwich_sauce) ? implode(", ", $request->sandwich_sauce) : null;
            $cheese = !empty($request->sandwich_cheese) ? implode(", ", $request->sandwich_cheese) : null;
            $veggies = !empty($request->sandwich_veggies) ? implode(", ", $request->sandwich_veggies) : null;
            $meat = !empty($request->sandwich_meat) ? implode(", ", $request->sandwich_meat) : null;
            $extra = !empty($request->sandwich_extra) ? implode(", ", $request->sandwich_extra) : null;
            $as_anOption = isset($request->as_anOption) ? $request->as_anOption : null;
        } else if (isset($request->category_type) && $request->category_type == 'Chicken') {
            $as_anOption = !empty($request->as_anOption) ? implode(", ", $request->as_anOption) : null;
            $sauce_on_the_side = isset($request->sauce_on_the_side) ? 1 : 0;
            $size = isset($request->size) ? $request->size : null;
        }
        //dd($as_anOption);

        $data = ItemMaster::create([
            'category_master_id' => $request->get('category_id'),
            'name' => $request->name,
            'description' => isset($request->description) ? $request->description : '',
            'sauces' =>  isset($sauce) ? $sauce : null,
            'cheese' => isset($cheese) ? $cheese : null,
            'meat_ingredients' => isset($meat) ? $meat : null,
            'veggies' => isset($veggies) ? $veggies : null,
            'extra' => isset($extra) ? $extra : null,

            'have_bread' => isset($request->bread) ? 1 : 0,
            'allowedExtraTopping' => isset($add_on_toppings) ? $add_on_toppings : 0,
            'as_anOption' => isset($as_anOption) ? $as_anOption : null,
            'sauce_on_the_side' => isset($sauce_on_the_side) && $sauce_on_the_side !== 0 ? 1 : 0,

            'calories' => $request->calories,
            'price' => isset($pricesConcatenated) ? $pricesConcatenated : $request->priceSM,
            'size' => isset($size) ? $size : null,
            'status' => true,
            'img' => $filename,
        ]);

        if ($data) {
            return response()->json([
                'status' => 1,
                'message' => 'Successfully added'
            ]);
        }
    }

    public function getItemForUpdate(Request $request, $id)
    {
        $data = ItemMaster::where('id', $id)
            //                            ->where('status','<>','2')
            ->first();

        $data2 = Category::where('status', '1')->get();

        //Fetching Ingredients
        $cheese = IngredientsMaster::where('based_on', 'cheese')->get();
        $sauce = IngredientsMaster::where('based_on', 'sauce')->get();
        $meat = IngredientsMaster::where('based_on', 'meat')->get();
        $veggies = IngredientsMaster::where('based_on', 'veggies')->get();

        return view('admin.product.product_update')
            ->with('data', $data)
            ->with('category', $data2)
            ->with('cheese', $cheese)
            ->with('sauce', $sauce)
            ->with('meat', $meat)
            ->with('veggies', $veggies);
    }

    public function updateItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'priceSM' => 'required|numeric',
            //            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'required',
            //            'veggies' => 'required',
            //            'meat' => 'required',
            //            'sauces' => 'required',
            'calories' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->first()
            ]);
        }
        // dd(request()->all())

        if ($request->file('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $request->file('image')->move(public_path('admin/images/items'), $filename);
        }

        $pricesConcatenated = implode(", ", [
            $request->priceSM,
            $request->priceM,
            $request->priceL,
            $request->priceXL
        ]);

        $item = ItemMaster::find($request->id);

        if ($item) {
            $item->update([
                'category_master_id' => $request->get('category_id'),
                'name' => $request->name,
                'description' => isset($request->description) ? $request->description : '',
                'sauces' => !empty($request->sauce) ? implode(", ", $request->sauce) : null,
                'cheese' => isset($request->cheese) ? implode(", ", $request->cheese) : null,
                'meat_ingredients' => !empty($request->meat) ? implode(", ", $request->meat) : null,
                'veggies' => !empty($request->veggies) ? implode(", ", $request->veggies) : null,
                'extra' => !empty($request->extra) ? implode(", ", $request->extra) : null,
                'calories' => isset($request->calories) ? $request->calories : $item['calories'],
                'price' => $pricesConcatenated,
                'size' => isset($request->size) ? $request->size : $item['size'],
                'status' => true,
                'img' => isset($filename) ? $filename : $item['img'],
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Successfully Updated thew item',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Item not found'
            ]);
        }
    }

    public function itemStatus(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->isChecked)) {
                $id = $request->id;

                $category = ItemMaster::find($id);
                if ($category) {

                    $category->update([
                        'status' => $request->isChecked == 'true' ? true : false,
                    ]);
                    //                    dd($category);
                    if ($request->isChecked == 'true') {
                        return response()->json([
                            'status' => true,
                            'message' => 'Successfully activated the Item'
                        ]);
                    } else {
                        return response()->json([
                            'status' => true,
                            'message' => 'Successfully deactivated the Item'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Category id not found'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'isChecked field is not found. ERROR'
                ]);
            }
        }
    }
}
