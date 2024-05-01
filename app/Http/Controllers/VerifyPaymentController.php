<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Perlu diimpor
use App\Models\Transaction;

class VerifyPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;

        $signature = hash('sha512', $orderId.$statusCode.$grossAmount.'SB-Mid-server-1-7UNhjHoogom6ZFREWAal65');

        Log::info('incoming-notification', $request->all()); // Sesuaikan dengan cara memanggil Log

        if ($signature != $request->signature_key) {
            return response()->json(['message' => 'invalid signature'], 400); // Sesuaikan dengan kode status HTTP yang valid
        }

        // Pastikan Anda mengimpor kelas Transaction
        $transaction = Transaction::find($request->order_id);
        if ($transaction) {
            $status = 'PENDING';
            if($request->transaction_status == 'settlement'){
                $status = 'PAID';
            } else if ($request->transaction_status == 'expired'){
                $status = 'EXPIRED';
            }
            $transaction->status = $status;
            $transaction->save();
        }

        return response()->json(['message' => 'success'], 200); // Sesuaikan dengan kode status HTTP yang valid
    }
}