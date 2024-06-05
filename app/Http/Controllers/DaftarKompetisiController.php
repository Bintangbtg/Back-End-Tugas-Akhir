<?php

namespace App\Http\Controllers;

use App\Models\DaftarKompetisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaftarKompetisiController extends Controller
{
    public function index()
    {
        $daftarKompetisis = DaftarKompetisi::all();
        return response()->json($daftarKompetisis, 200);
    }

    public function store(Request $request)
    {
        // if (!Auth::check()) {
        //     return response()->json([
        //         'message' => 'Login Dulu coy!',
        //     ], 401);
        // }

        $validator = Validator::make($request->all(), [
            'id_kompetisi' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $daftarKompetisi = DaftarKompetisi::create($request->all());

        return response()->json($daftarKompetisi, 201);
    }

    public function show($id)
    {
        $daftarKompetisi = DaftarKompetisi::findOrFail($id);
        return response()->json($daftarKompetisi, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_kompetisi' => 'required',
            'nama' => 'required',
            'email' => 'required|email|unique:daftar_kompetisi,email,' . $id,
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $daftarKompetisi = DaftarKompetisi::findOrFail($id);

            $daftarKompetisi->update($request->all());

            return response()->json($daftarKompetisi, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $daftarKompetisi = DaftarKompetisi::findOrFail($id);
        $daftarKompetisi->delete();

        return response()->json(null, 204);
    }
}