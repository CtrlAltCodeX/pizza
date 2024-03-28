<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CloverService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createSesison()
    {
        echo "Please wait redirecting you to payment page...........";

        return redirect()->route('card.details', ['id' => request()->id]);
    }

    public function cardDetails()
    {
        // if (session()->get('paymentId') == request()->id) {
        return view('web.enter-info');
        // } else {
        // return 'Token is expired try again later..........';
        // }
    }

    public function generatePaymentLink(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Please login first'], 500);
        }

        $client = new Client();

        $items = [];
        $total = 0;
        foreach ($request->items as $item) {
            $info['note'] = 'Order Payment';
            $info['price'] = (float) $item['price'];
            $info['name'] = $item['name'];
            $info['unitQty'] = (float) $item['quantity'];

            $total += (float) $item['price'];

            array_push($items, $info);
        }

        $data = json_encode([
            'customer' => [
                'id' => rand(),
                'firstName' => explode(' ', auth()->user()->name)[0],
                'lastName' => explode(' ', auth()->user()->name)[1] ?? '',
                'email' => auth()->user()->email,
                'phoneNumber' => auth()->user()->mobile_no,
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
            $response = $client->post('https://sandbox.dev.clover.com/invoicingcheckoutservice/v1/checkouts', [
                'body' => $data,
                'headers' => [
                    'X-Clover-Merchant-Id' => 'KY1E74GAQVR11',
                    'authorization' => 'Bearer 31800200-0b32-4a4d-b5a0-ee41828744da',
                    'accept' => 'application/json',
                    'content-type' => 'application/json'
                ],
            ]);

            $tokenData = json_decode($response->getBody(), true);

            // Handle token data as needed
            return response()->json($tokenData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkout()
    {
        return view('web.checkout');
    }

    public function success()
    {
        return view('web.success');
    }
}
