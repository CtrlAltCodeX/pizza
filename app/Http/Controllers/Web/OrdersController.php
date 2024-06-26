<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\IngredientsMaster;
use App\Models\ItemMaster;
use App\Models\OrderDetails;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index($slug)
    {
        $categoryAll = Category::all();
        $categoryId = Category::where('slug', $slug)->value('id');
        $items = ItemMaster::where('category_master_id', $categoryId)->get();

        $ingredients = IngredientsMaster::where('used_in', $categoryId)->get();
        $data = [];
        $all = [];

        foreach ($ingredients as $ingredient) {
            $basedOn = $ingredient->based_on;
            if (!isset($all[$basedOn])) {
                $all[$basedOn] = [];
            }
            $all[$basedOn][] = $ingredient->toArray();
        }

        //selecting and giving names according to the pizza ingredients.
        foreach ($items as $index => $item) {
            $priceArray = explode(', ', $item->price);
            $sizeArray = explode(', ', $item->size);

            $data[$index] = [
                'id' => $item->id,
                'category_master_id' => $item->category_master_id,
                'name' => $item->name,
                'description' => $item->description,
                'calories' => $item->calories,
                'price' => $priceArray,
                'size' => $sizeArray,
                'img' => $item->img,
                'all' => [],
                'status' => $item->status,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];

            if ($item->cheese) {
                $cheeseIngredient = $ingredients->where('id', $item->cheese)->first();
                if ($cheeseIngredient) {
                    $data[$index]['cheese'] = [
                        'id' => $cheeseIngredient->id,
                        'name' => $cheeseIngredient->name,
                    ];

                    $data[$index]['all'][] = $cheeseIngredient->name;
                }
            }

            if ($item->sauces) {
                $saucesIds = explode(',', $item->sauces);
                $sauces = $ingredients->whereIn('id', $saucesIds);
                $data[$index]['sauces'] = $sauces->map(function ($sauce) {
                    return [
                        'id' => $sauce->id,
                        'name' => $sauce->name,
                    ];
                })->all();

                $data[$index]['all'] = array_merge($data[$index]['all'], $sauces->pluck('name')->all());
            }

            if (isset($data[$index]['sauces'])) {
                $data[$index]['sauces'] = array_values($data[$index]['sauces']);
            }

            if ($item->meat_ingredients) {
                $meatIds = explode(',', $item->meat_ingredients);

                $meat = $ingredients->whereIn('id', $meatIds);
                $data[$index]['meat'] = $meat->map(function ($meat_ingredients) {
                    return [
                        'id' => $meat_ingredients->id,
                        'name' => $meat_ingredients->name,
                    ];
                })->all();
                $data[$index]['all'] = array_merge($data[$index]['all'], $meat->pluck('name')->all());
            }

            if (isset($data[$index]['meat'])) {
                $data[$index]['meat'] = array_values($data[$index]['meat']);
            }

            if ($item->veggies) {
                $veggiesIds = explode(',', $item->veggies);
                $veggies = $ingredients->whereIn('id', $veggiesIds);
                $data[$index]['veggies'] = $veggies->map(function ($veggie) {
                    return [
                        'id' => $veggie->id,
                        'name' => $veggie->name,
                        // Add other veggie attributes as needed
                    ];
                })->all();
                $data[$index]['all'] = array_merge($data[$index]['all'], $veggies->pluck('name')->all());
            }

            // Resetting keys for veggies array
            if (isset($data[$index]['veggies'])) {
                $data[$index]['veggies'] = array_values($data[$index]['veggies']);
            }
        }

        $shops = Shop::all();

        return view('web.order')
            ->with('categories', $categoryAll)
            ->with('pizza', $data)
            ->with('all', $all)
            ->with('shops', $shops);
    }

    public function ordering(Request $request)
    {
        if ($request->ajax() && isset($request->idOfPizza)) {
            $val = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'street' => 'required',
                'appartment' => 'required',
                'streetName' => 'required',
                'city' => 'required',
            ]);

            if ($val->fails()) {
                return response()->json([
                    'status' => 0,
                    'message' => $val->errors()->first(),
                ]);
            }

            $data = ItemMaster::where('id', $request->idOfPizza)->first();

            $price = explode(", ", $data['price']);
            $size = explode(", ", $data['size']);

            // Get today's date in the desired format
            $todayDate = Carbon::today()->format('dmY');

            // Get the latest order number for today's date
            $latestOrder = OrderDetails::where('orderMaster_id', 'like', $todayDate . '_%')
                ->latest('orderMaster_id')
                ->first();

            // If no orders exist for today's date, set the order number to 1
            if (!$latestOrder) {
                $orderNo = 1;
            } else {
                // Extract the order number part and increment it
                $orderNo = floatval(substr($latestOrder->orderMaster_id, -2)) + 1;
            }

            // Pad the order number with leading zeros if necessary
            $paddedOrderNo = str_pad($orderNo, 2, '0', STR_PAD_LEFT);

            // Combine today's date and the order number to generate the order ID
            $orderId = $todayDate . '_' . $paddedOrderNo;

            $data = OrderDetails::create([
                'orderMaster_id' => $orderId,
                'item_id' => $request->idOfPizza,
                'name' => $data['name'],
                'quantity' => 1,
                'price' => $price[0],
                'size' => $size[0],
                'category_id' => $data['category_master_id'],
                'category_name' => 'pizza',
                'igredients_used_id' => $data['sauces'] . ',' . $data['cheese'] . ',' . $data['meat_ingredients'] . ',' . $data['veggies'],
            ]);

            if ($data) {
                return response()->json([
                    'status' => 1,
                    'message' => $orderId,
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => "Something went wrong",
                ]);
            }
        }
    }

    public function deliverySetup(Request $request)
    {

        $val = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'street' => 'required',
            'apartment' => 'required',
            'streetName' => 'required',
            'postCode' => 'required|numeric',
            'city' => 'required',
        ]);

        if ($val->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $val->errors()->first()
            ]);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'street' => $request->street,
            'apartment' => $request->apartment,
            'streetName' => $request->streetName,
            'postCode' => $request->postCode,
            'city' => $request->city,
            'store' => $request->store,
        ];

        Session::put('delivery_details', $data);

        if (Session::has('delivery_details')) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Please setup the delivery details'
            ]);
        }
        // }
    }

    public function pickupSetup(Request $request)
    {
        if ($request->ajax()) {

            $val = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric'
            ]);

            if ($val->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $val->errors()->first()
                ]);
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'shop' => $request->shop
            ];

            Session::put('pickup_details', $data);
            if (Session::has('pickup_details')) {
                return response()->json([
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please setup the delivery details'
                ]);
            }
        }
    }

    public function getPizzaDetails(Request $request)
    {
        if ($request->ajax()) {
            $pizza = ItemMaster::where('id', $request->id)
                ->first()
                ->toArray();

            return response()->json([
                'status' => 'success',
                'data' => $pizza
            ]);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $id = $request->input('id');
            $name = $request->input('name');
            $type = $request->input('type');
            $image = $request->input('image');
            $quantity = $request->input('quantity');
            $size = $request->input('size');
            $price = $request->input('price');
            $crust = $request->input('crust');
            $thickness = $request->input('thickness');
            $sauce = $request->input('sauce');
            $cheese = $request->input('cheese');
            $meat = $request->input('meat');
            $veggies = $request->input('veggies');
            $extraSauce = $request->input('extraSauce');

            $cart = Session::get('cart', []);

            $sumAmt = 0;
            if (isset($cart[$name])) {
                $prevPrice = (float) $cart[$name]['price'];
                $prevQty = (float) $cart[$name]['quantity'];

                foreach ($cart[$name] as $key => $item) {
                    if (
                        $key == 'crust'
                        || $key == 'thickness'
                        || $key == 'sauce'
                        || $key == 'cheese'
                        || $key == 'meat'
                        || $key == 'veggies'
                        || $key == 'extraSauce'
                    ) {
                        if ($item) {
                            foreach ($item as $topping) {
                                $sumAmt = $sumAmt + $topping['price'];
                            }
                        }
                    }
                }
                $cart[$name]['quantity'] =  $prevQty + (float) $quantity;
                $cart[$name]['total'] =  ((float) $price * (float) $cart[$name]['quantity']) + $sumAmt;
                $cart[$name]['price'] =  $price;
            } else {
                $cart[$name] = [
                    'id' => $id,
                    'name' => $name,
                    'type' => $type,
                    'image' => $image,
                    'quantity' => $quantity,
                    'total' => (float) $price * (float) $quantity,
                    'size' => $size,
                    'price' => $price,
                    'crust' => $crust,
                    'thickness' => $thickness,
                    'sauce' => $sauce,
                    'cheese' => $cheese,
                    'meat' => $meat,
                    'veggies' => $veggies,
                    'extraSauce' => $extraSauce
                ];

                foreach ($cart[$name] as $key => $item) {
                    if (
                        $key == 'crust'
                        || $key == 'thickness'
                        || $key == 'sauce'
                        || $key == 'cheese'
                        || $key == 'meat'
                        || $key == 'veggies'
                        || $key == 'extraSauce'
                    ) {
                        if ($item) {
                            foreach ($item as $topping) {
                                $sumAmt = $sumAmt + (int) $topping['price'];
                            }
                        }
                    }
                }

                $cart[$name]['price'] = $cart[$name]['price'] + $sumAmt;
            }

            Session::put('cart', $cart);

            return response()->json([
                'status' => 'success',
                'message' => 'Items added to cart successfully'
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function cart(Request $request)
    {
        if ($request->ajax()) {
            $cart = Session::get('cart');

            return response()->json([
                'status' => 'success',
                'cart' => $cart
            ]);
        }
    }

    public function removeCartItem(Request $request)
    {
        if ($request->ajax()) {
            $cart = Session::get('cart');
            unset($cart[request()->item]);

            $cart = Session::put('cart', $cart);

            return response()->json([
                'status' => 'success',
                'cart' => $cart
            ]);
        }
    }
}
