<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // Mendapatkan file berdasarkan folder
    public function index($folder_id)
    {
        $files = File::where('folder_id', $folder_id)->get();
        return response()->json($files);
    }

    // Membuat file baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'folder_id' => 'required|exists:folders,id',
        ]);

        $file = File::create($request->all());
        return response()->json($file, 201);
    }

    // Menghapus file
    public function destroy($id)
    {
        $file = File::find($id);
        if ($file) {
            $file->delete();
            return response()->json(['message' => 'File deleted successfully']);
        }

        return response()->json(['message' => 'File not found'], 404);
    }
}
