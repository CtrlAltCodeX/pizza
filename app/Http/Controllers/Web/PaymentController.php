<?php

namespace App\Http\Web\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CloverService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $cloverService;

    public function __construct(CloverService $cloverService)
    {
        $this->cloverService = $cloverService;
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'order_id' => 'required|string',
        ]);

        $amount = $request->input('amount');
        $orderId = $request->input('order_id');

        $paymentResponse = $this->cloverService->processPayment($amount, $orderId);

        // Handle payment response

        return redirect()->back()->with('message', 'Payment processed successfully.');
    }

    public function redirectToHostedPaymentPage(Request $request)
    {
        // Generate the payment link using Clover's API or dashboard
        $paymentLink = 'https://your-clover-hosted-payment-page.com';

        // Redirect the user to the hosted payment page
        return redirect()->away($paymentLink);
    }
}
