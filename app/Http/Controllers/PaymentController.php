<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Registered;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;
use GuzzleHttp\Client;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Validate the form data
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'event_id' => 'required|integer',
            'event_name' => 'required|string',
        ]);

        $bookingData = [
            'event_id' => $request->event_id,
            'event_name' => $request->event_name,
            'registered_name' => $request->fullName,
            'registered_email' => $request->email,
            'registered_phone' => $request->phone,
            'event_cost' => $request->event_cost,
            'payment_status' => true,
        ];

        //jika tidak berbayar
        if (!$request->paid_status) {

            $bookingReference = 'INV-' . time();
            session([
                'booking_data' => $bookingData,
                'booking_reference' => $bookingReference
            ]);
            return redirect()->route('payment.success');
        }

        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds = config('midtrans.is_3ds');

        $orderId = 'INV-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 1000,
            ],
            'customer_details' => [
                'first_name' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
            ]// optional: pilih metode tertentu
        ];

        $snapToken = Snap::getSnapToken($params);

        $bookingReference = $orderId;
        session([
            'booking_data' => $bookingData,
            'booking_reference' => $bookingReference
        ]);
        // Kirim ke view custom
        return view('payments.snap', compact('snapToken', 'orderId', 'bookingData'));
    }

    // private function simulatePaymentGateway($data)
    // {
    //     // This is a simulation - in real app, you'd integrate with:
    //     // - Midtrans (Indonesia)
    //     // - Xendit (Indonesia)
    //     // - Stripe (International)
    //     // - etc.

    //     // For demo purposes, we'll simulate successful payment
    //     return redirect()->route('payment.success');
    // }

    public function success()
    {
        $bookingData = session('booking_data');
        $reference = session('booking_reference');

        $Registered = Registered::Create([
            'event_id' => $bookingData['event_id'],
            'registered_name' => $bookingData['registered_name'],
            'registered_email' => $bookingData['registered_email'],
            'registered_phone' => $bookingData['registered_phone'],
            'payment_status' => $bookingData['payment_status'],
        ]);

        $qrData = [
            'event_id' => $bookingData['event_id'],
            'registered_id' => $Registered->registered_id,
        ];
        $qrBinary = QrCode::format('png')
            ->size(340)
            ->generate(json_encode($qrData));
        $qrBase64 = base64_encode($qrBinary);
        $qrPng = QrCode::format('png')->size(300)->generate(json_encode($qrData));
        $fileName = "QR_event_{$qrData['event_id']}_id_{$qrData['registered_id']}.png";
        Storage::disk('public')->put("qr/{$fileName}", $qrPng);
        if (!$bookingData) {
            return redirect('/');
        }

        session()->forget(['booking_data', 'booking_reference']);

        return view('payments.success', [
            'bookingData' => $bookingData,
            'reference' => $reference,
            'qrBase64' => $qrBase64,
            'fileName' => $fileName,
        ]);
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}