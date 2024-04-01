<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;

class ProfileController extends Controller
{
    // Metode untuk mengambil semua data profil
    public function getAll()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }

    // Metode untuk menambahkan profil baru
    public function tambah(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'username' => 'required|unique:profiles',
            'full_name' => 'required',
            'role' => 'required|in:Hacker,Hipster,Hustler',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'city' => 'required',
            'state' => 'required',
        ]);

        $profile = Profile::create($request->all());

        return response()->json($profile, 201);
    }

    // Metode untuk menampilkan detail profil berdasarkan ID
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return response()->json($profile);
    }

    // Metode untuk memperbarui profil berdasarkan ID
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:profiles,username,' . $id,
            'full_name' => 'required',
            'role' => 'required|in:Hacker,Hipster,Hustler',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'city' => 'required',
            'state' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $profile = Profile::findOrFail($id);

            $profile->update([
                'username' => $request->username,
                'full_name' => $request->full_name,
                'role' => $request->role,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'state' => $request->state,
            ]);

            return response()->json($profile, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Metode untuk menghapus profil berdasarkan ID
    public function delete($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json(null, 204);
    }
}