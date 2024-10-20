<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\DB;

class FolderController extends Controller
{
    // Mendapatkan semua folder
    public function index()
    {
        $folders = Folder::with('subfolders')->whereNull('parent_id')->get();
        return response()->json($folders);
    }

    public function showSubfolders($id)
    {
        $subfolders = Folder::where('parent_id', $id)->get(); // Mengambil folder yang memiliki parent_id sesuai dengan ID yang diterima
        
        return response()->json($subfolders);
    }

    public function subfolders($id)
    {
        $subfolders = Folder::where('parent_id', $id)->get();
        return response()->json($subfolders);
    }


    // Membuat folder baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:folders,id',
        ]);

        // $folder = Folder::create($request->all());
        $folder = Folder::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($folder, 201);
    }

    public function getFilesInFolder($folderId)
    {
        $files = File::where('folder_id', $folderId)->get();
        return response()->json($files);
    }

    // Menambahkan file baru ke dalam folder
    public function addFile(Request $request, $folderId)
    {
        $request->validate([
            'fileName' => 'required|string|max:255',
        ]);

        $file = File::create([
            'name' => $request->fileName,
            'folder_id' => $folderId,
        ]);

        return response()->json(['message' => 'File added successfully', 'file' => $file], 201);
    }

    // Menghapus folder
    public function destroy($id)
    {
        $folder = Folder::find($id);
        if ($folder) {
            $folder->delete();
            return response()->json(['message' => 'Folder deleted successfully']);
        }

        return response()->json(['message' => 'Folder not found'], 404);
    }
}
