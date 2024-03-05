<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function addProfile(Request $req)
    {
        // Validasi data yang diterima dari permintaan POST
        $validator = Validator::make($req->all(), [
            'username' => 'required|string',
            'full_name' => 'required|string',
            'role' => 'required|in:Hacker,Hipster,Hustler',
        ]);

        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Buat instance baru dari model Profile dengan data yang diterima dari permintaan
        $profile = new Profile([
            'username' => $req->input('username'),
            'full_name' => $req->input('full_name'),
            'role' => $req->input('role'),
        ]);

        // Simpan data profile baru ke dalam database
        $profile->save();

        // Berikan respons JSON sesuai dengan hasil penyimpanan
        if ($profile) {
            return response()->json(['status' => true, 'message' => 'Sukses menambahkan profil']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambahkan profil']);
        }
    }
}
