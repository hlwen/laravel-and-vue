<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    //
    public function upload(Request $request)
    {

        if ($request->isMethod('POST')) {
            $file = $request->file('source');
            if ($file->isValid()) {
                $originalName = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $type = $file->getClientMimeType();
                $realPath = $file->getRealPath();
                $filename = date('y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
               $bool =  Storage::disk('uploads')->put($filename,file_get_contents($realPath));

               var_dump($bool);
            }
            dd($file);
            exit;
        }
        return view('student.upload');
    }
}
