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

    public function createCardToken(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post('https://token-sandbox.dev.clover.com/v1/tokens', [
                'form_params' => [
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'number' => $request->card_number,
                    'cvv' => $request->cvv,
                ],
                'headers' => [
                    'Authorization' => 'Bearer 31800200-0b32-4a4d-b5a0-ee41828744da',
                    'Accept' => 'application/json',
                ],
            ]);

            $tokenData = json_decode($response->getBody(), true);

            // Handle token data as needed
            return response()->json($tokenData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
