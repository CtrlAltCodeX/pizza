<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ItemMaster;
use App\Models\Order;
use App\Models\OrderDetails;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function generatePaymentLink(Request $request)
    {
        $client = new Client();

        $items = [];
        $total = 0;
        foreach ($request->items as $item) {
            $info['note'] = 'Order Payment';
            $info['price'] = (float) $item['price'] * 100;
            $info['name'] = $item['name'];
            $info['unitQty'] = (float) $item['quantity'];

            $total += (float) $item['price'];

            array_push($items, $info);
        }

        $orderId = rand();

        $data = json_encode([
            'customer' => [
                'id' => $orderId,
                'firstName' => request()->info['first_name'],
                // 'lastName' => request()->info['last_name'],
                'email' => request()->info['email'],
                'phoneNumber' => 232131,
                "address" =>  request()->address
            ],
            'shoppingCart' => [
                'total' => $total,
                'subtotal' => $total,
                'totalTaxAmount' => 0,
                'tipAmount' => 0,
                'lineItems' => $items
            ],
        ]);

        try {
            $response = $client->post(env('APIURL') . '/invoicingcheckoutservice/v1/checkouts', [
                'body' => $data,
                'headers' => [
                    'X-Clover-Merchant-Id' => env('MERCHANTID'),
                    'authorization' => 'Bearer ' . env('APITOKEN'),
                    'accept' => 'application/json',
                    'content-type' => 'application/json'
                ],
            ]);

            $tokenData = json_decode($response->getBody(), true);

            $order = Order::create([
                'order_id' => $orderId,
                'first_name' => request()->info['first_name'],
                // 'last_name' => request()->info['last_name'],
                'email' => request()->info['email'],
                'mobile' => request()->info['mobile'],
                'address' => request()->address['address1'],
                'address2' => request()->address['address2'],
                'country_code' => request()->address['country'],
                'state' => request()->address['state'],
                'city' => request()->address['state'],
                'zip' => request()->address['zip'],
                'payment_method' => 'Clover',
                'total' => $total,
            ]);

            $items = [];
            $total = 0;
            foreach ($request->items as $item) {
                $data = ItemMaster::find($item['id']);

                $price = explode(", ", $data['price']);
                $size = explode(", ", $data['size']);

                OrderDetails::create([
                    'orderMaster_id' => $order->id,
                    'item_id' => $item['id'],
                    'name' => $data['name'],
                    'quantity' => $item['quantity'],
                    'price' => $price[0],
                    'size' => $size[0],
                    'category_id' => $data['category_master_id'],
                    'category_name' => 'pizza',
                    'igredients_used_id' => $data['sauces'] . ',' . $data['cheese'] . ',' . $data['meat_ingredients'] . ',' . $data['veggies'],
                ]);
            }

            // Handle token data as needed
            return response()->json($tokenData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkout()
    {
        if (!session()->get('cart')) return redirect()->to("/");

        $countries = [
            'AF' => 'Afghanistan', 'AL' => 'Albania', 'DZ' => 'Algeria', 'AD' => 'Andorra', 'AO' => 'Angola', 'AG' => 'Antigua and Barbuda', 'AR' => 'Argentina', 'AM' => 'Armenia', 'AU' => 'Australia', 'AT' => 'Austria',
            'AZ' => 'Azerbaijan', 'BS' => 'Bahamas', 'BH' => 'Bahrain', 'BD' => 'Bangladesh', 'BB' => 'Barbados', 'BY' => 'Belarus', 'BE' => 'Belgium', 'BZ' => 'Belize', 'BJ' => 'Benin', 'BT' => 'Bhutan',
            'BO' => 'Bolivia', 'BA' => 'Bosnia and Herzegovina', 'BW' => 'Botswana', 'BR' => 'Brazil', 'BN' => 'Brunei', 'BG' => 'Bulgaria', 'BF' => 'Burkina Faso', 'BI' => 'Burundi', 'CV' => 'Cabo Verde', 'KH' => 'Cambodia',
            'CM' => 'Cameroon', 'CA' => 'Canada', 'CF' => 'Central African Republic', 'TD' => 'Chad', 'CL' => 'Chile', 'CN' => 'China', 'CO' => 'Colombia', 'KM' => 'Comoros', 'CD' => 'Congo', 'CR' => 'Costa Rica',
            'HR' => 'Croatia', 'CU' => 'Cuba', 'CY' => 'Cyprus', 'CZ' => 'Czech Republic', 'DK' => 'Denmark', 'DJ' => 'Djibouti', 'DM' => 'Dominica', 'DO' => 'Dominican Republic', 'TL' => 'East Timor', 'EC' => 'Ecuador',
            'EG' => 'Egypt', 'SV' => 'El Salvador', 'GQ' => 'Equatorial Guinea', 'ER' => 'Eritrea', 'EE' => 'Estonia', 'SZ' => 'Eswatini', 'ET' => 'Ethiopia', 'FJ' => 'Fiji', 'FI' => 'Finland', 'FR' => 'France',
            'GA' => 'Gabon', 'GM' => 'Gambia', 'GE' => 'Georgia', 'DE' => 'Germany', 'GH' => 'Ghana', 'GR' => 'Greece', 'GD' => 'Grenada', 'GT' => 'Guatemala', 'GN' => 'Guinea', 'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana', 'HT' => 'Haiti', 'HN' => 'Honduras', 'HU' => 'Hungary', 'IS' => 'Iceland', 'IN' => 'India', 'ID' => 'Indonesia', 'IR' => 'Iran', 'IQ' => 'Iraq', 'IE' => 'Ireland',
            'IL' => 'Israel', 'IT' => 'Italy', 'CI' => 'Ivory Coast', 'JM' => 'Jamaica', 'JP' => 'Japan', 'JO' => 'Jordan', 'KZ' => 'Kazakhstan', 'KE' => 'Kenya', 'KI' => 'Kiribati', 'XK' => 'Kosovo',
            'KW' => 'Kuwait', 'KG' => 'Kyrgyzstan', 'LA' => 'Laos', 'LV' => 'Latvia', 'LB' => 'Lebanon', 'LS' => 'Lesotho', 'LR' => 'Liberia', 'LY' => 'Libya', 'LI' => 'Liechtenstein', 'LT' => 'Lithuania',
            'LU' => 'Luxembourg', 'MG' => 'Madagascar', 'MW' => 'Malawi', 'MY' => 'Malaysia', 'MV' => 'Maldives', 'ML' => 'Mali', 'MT' => 'Malta', 'MH' => 'Marshall Islands', 'MR' => 'Mauritania', 'MU' => 'Mauritius',
            'MX' => 'Mexico', 'FM' => 'Micronesia', 'MD' => 'Moldova', 'MC' => 'Monaco', 'MN' => 'Mongolia', 'ME' => 'Montenegro', 'MA' => 'Morocco', 'MZ' => 'Mozambique', 'MM' => 'Myanmar', 'NA' => 'Namibia',
            'NR' => 'Nauru', 'NP' => 'Nepal', 'NL' => 'Netherlands', 'NZ' => 'New Zealand', 'NI' => 'Nicaragua', 'NE' => 'Niger', 'NG' => 'Nigeria', 'KP' => 'North Korea', 'MK' => 'North Macedonia', 'NO' => 'Norway',
            'OM' => 'Oman', 'PK' => 'Pakistan', 'PW' => 'Palau', 'PS' => 'Palestine', 'PA' => 'Panama', 'PG' => 'Papua New Guinea', 'PY' => 'Paraguay', 'PE' => 'Peru', 'PH' => 'Philippines', 'PL' => 'Poland',
            'PT' => 'Portugal', 'QA' => 'Qatar', 'RO' => 'Romania', 'RU' => 'Russia', 'RW' => 'Rwanda', 'KN' => 'Saint Kitts and Nevis', 'LC' => 'Saint Lucia', 'VC' => 'Saint Vincent and the Grenadines', 'WS' => 'Samoa', 'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe', 'SA' => 'Saudi Arabia', 'SN' => 'Senegal', 'RS' => 'Serbia', 'SC' => 'Seychelles', 'SL' => 'Sierra Leone', 'SG' => 'Singapore', 'SK' => 'Slovakia', 'SI' => 'Slovenia', 'SB' => 'Solomon Islands',
            'SO' => 'Somalia', 'ZA' => 'South Africa', 'KR' => 'South Korea', 'SS' => 'South Sudan', 'ES' => 'Spain', 'LK' => 'Sri Lanka', 'SD' => 'Sudan', 'SR' => 'Suriname', 'SE' => 'Sweden', 'CH' => 'Switzerland',
            'SY' => 'Syria', 'TW' => 'Taiwan', 'TJ' => 'Tajikistan', 'TZ' => 'Tanzania', 'TH' => 'Thailand', 'TG' => 'Togo', 'TO' => 'Tonga', 'TT' => 'Trinidad and Tobago', 'TN' => 'Tunisia', 'TR' => 'Turkey',
            'TM' => 'Turkmenistan', 'TV' => 'Tuvalu', 'UG' => 'Uganda', 'UA' => 'Ukraine', 'AE' => 'United Arab Emirates', 'GB' => 'United Kingdom', 'US' => 'United States', 'UY' => 'Uruguay', 'UZ' => 'Uzbekistan', 'VU' => 'Vanuatu',
            'VA' => 'Vatican City', 'VE' => 'Venezuela', 'VN' => 'Vietnam', 'YE' => 'Yemen', 'ZM' => 'Zambia', 'ZW' => 'Zimbabwe'
        ];

        if (session()->get('pickup_details')) {
            $name = session()->get('pickup_details')['name'];
        } else if (auth()->check()) {
            $name = auth()->user()->name;
        } else {
            $name = '';
        }

        if (session()->get('pickup_details')) {
            $email = session()->get('pickup_details')['email'];
        } else if (auth()->check()) {
            $email = auth()->user()->email;
        } else {
            $email = '';
        }

        if (session()->get('pickup_details')) {
            $phone = session()->get('pickup_details')['phone'];
        } else if (auth()->check()) {
            $phone = auth()->user()->phone;
        } else {
            $phone = '';
        }


        return view('web.checkout', compact('countries', 'email', 'phone', 'name'));
    }

    public function orderSave(Request $request)
    {
        $items = [];
        $total = 0;
        foreach ($request->items as $item) {
            $info['note'] = 'Order Payment';
            $info['price'] = (float) $item['price'] * 100;
            $info['name'] = $item['name'];
            $info['unitQty'] = (float) $item['quantity'];

            $total += (float) $item['price'];

            array_push($items, $info);
        }

        $orderId = rand();

        if ($getDelivery = Session::get("delivery_details")) {
            $store = $getDelivery['shop'];
        } else if ($getPickup = Session::get("pickup_details")) {
            $store = $getPickup['shop'];
        }

        $order_id = Order::create([
            'order_id' => $orderId,
            'first_name' => request()->info['first_name'],
            // 'last_name' => request()->info['last_name'],
            'email' => request()->info['email'],
            'mobile' => request()->info['mobile'],
            'address' => request()->address['address1'],
            'address2' => request()->address['address2'],
            'country_code' => request()->address['country'],
            'state' => request()->address['state'],
            'city' => request()->address['state'],
            'zip' => request()->address['zip'],
            'payment_method' => 'COD',
            'total' => $total,
            'shop' => $store,
        ]);

        foreach ($request->items as $item) {
            $data = ItemMaster::find($item['id']);

            $price = explode(", ", $data['price']);
            $size = explode(", ", $data['size']);

            OrderDetails::create([
                'orderMaster_id' => $order_id->id,
                'item_id' => $item['id'],
                'name' => $data['name'],
                'quantity' => $item['quantity'],
                'price' => (int) $item['price'],
                'size' => $item['size'],
                'category_id' => $data['category_master_id'],
                'category_name' => 'pizza',
                'igredients_used_id' => $data['sauces'] . ',' . $data['cheese'] . ',' . $data['meat_ingredients'] . ',' . $data['veggies'],
            ]);
        }

        return response()->json([
            'success' => true,
        ], 200);
    }

    public function success()
    {
        if (!session()->get('cart')) return redirect()->to("/");

        session()->forget('cart');

        return view('web.success');
    }
}
