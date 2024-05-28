<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction; // Pastikan untuk mengimpor model Transaction jika ini adalah model Anda

class ProccesPaymentController extends Controller
{
    public function invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'biaya_pendaftaran' => 'required',
            'id_pendaftaran' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()], 422);
        }

        $transaction = Transaction::create([
            'name' => $request->name,
            'biaya_pendaftaran' => $request->biaya_pendaftaran, 
            'id_pendaftaran'=> $request->id, 
            'status' => 'CREATED'
        ]);

        $resp = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->withBasicAuth('SB-Mid-server-1-7UNhjHoogom6ZFREWAal65','SB-Mid-client-Jyw2cbkdoujTwNb9')
        ->post('https://api.sandbox.midtrans.com/v2/charge', [
            'payment_type' => 'gopay',
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->biaya_pendaftaran
            ]
        ]);

        if ($resp->status() == 201 || $resp->status() == 200) {
            $actions = $resp->json()['actions']; // Perbaikan typo di sini
            if (empty($actions)) {
                return response()->json(['message' => $resp['status_message']], 500);
            }
            $actionMap = [];
            foreach ($actions as $action) {
                $actionMap[$action['name']] = $action['url'];
            }

            return response()->json(['qr' => $actionMap['generate-qr-code']]);
        }

        return response()->json(['message' => $resp->body()], 500);
    }
}