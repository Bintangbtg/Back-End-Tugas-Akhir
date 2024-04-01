<?php

namespace App\Http\Controllers;

use App\Models\kompetisi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class kompetisiController extends Controller
{
    public function getall()
    {
        $kompetisis = Kompetisi::all();
        return response()->json($kompetisis, 200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'nama_kompetisi' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required|in:desain,programming,robotic,CTF',
            'biaya_pendaftaran' => 'required|numeric',
            'foto_poster' => 'nullable|string',
        ]);

        $kompetisi = Kompetisi::create($request->all());

        return response()->json($kompetisi, 201);
    }

    public function show($id)
    {
        $kompetisi = Kompetisi::findOrFail($id);
        return response()->json($kompetisi, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kompetisi' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required|in:desain,programming,robotic,CTF',
            'biaya_pendaftaran' => 'required|numeric',
            'foto_poster' => 'nullable|string', // Allow null or string for optional image
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $kompetisi = Kompetisi::findOrFail($id);

            $kompetisi->update([
                'nama_kompetisi' => $request->nama_kompetisi,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'biaya_pendaftaran' => $request->biaya_pendaftaran,
                'foto_poster' => $request->foto_poster, // Update poster if provided
            ]);

            return response()->json($kompetisi, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function hapus($id)
    {
        $kompetisi = Kompetisi::findOrFail($id);
        $kompetisi->delete();

        return response()->json(null, 204);
    }
}