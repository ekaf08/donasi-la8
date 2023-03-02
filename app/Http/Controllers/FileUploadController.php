<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('path_image')) {
            $file = $request->file('path_image');
            $filename = $file->getClientOriginalName();
            $folder = "campaign" . "/" . now()->format('Y') . "/" . now()->format('F') . "/" . uniqid() . "-" . now()->timestamp;
            $file->storeAs('public/image/' . $folder, $filename);
            return $folder;
        }
        return;
    }

    public function save($data)
    {
        FileUpload::create($data);
        return;
    }

    // Revert Filepond - Fungsi untuk handle ketika melakukan pembatalan.
    public function delete(Request $request)
    {
        $id = $request->getContent();
        Storage::disk('public')->deleteDirectory('image/' . $id);
    }
}
