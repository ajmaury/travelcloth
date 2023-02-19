<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\FileManagement;

class UploadFileController extends Controller {
   public function fileUpload() {
      return view('uploadfile');
   }
   public function fileUploadPost(Request $request) {
      $request->validate([
         'file' => 'required|mimes:pdf,xlx,csv|max:9048',
     ]);
     $destination = 'kyc_doc';
     $fileName = $destination.time().rand(1,100).'.'.$request->file->extension();  
     $request->file->move(storage_path('app/public/'.$destination), $fileName);

     return back()
         ->with('success','You have successfully upload file.')
         ->with('file',$fileName);
   }
}
