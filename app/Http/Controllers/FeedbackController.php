<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Validation\ValidationException;

class FeedbackController extends Controller
{
    // Menampilkan semua feedback
    public function index()
    {
        return Feedback::all();
    }

    // Menyimpan feedback baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pengirim' => 'required',
            'feedback' => 'required',
        ]);

        return Feedback::create($validatedData);
    }

    // Menampilkan feedback berdasarkan ID
    public function show($id)
    {
        return Feedback::findOrFail($id);
    }

    // Mengupdate feedback
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_pengirim' => 'required',
            'feedback' => 'required',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update($validatedData);

        return $feedback;
    }

    // Menghapus feedback
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return response()->noContent();
    }
}