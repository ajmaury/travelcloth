<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\FileManagement;

class UploadFileController extends Controller {
   public function index() {
      return view('uploadfile');
   }
   public function showUploadFile(Request $request) {
       // $file_upload = FileManagement::upload_single_file($request,'image','ajay2','','100',''); 
        $file_upload = FileManagement::view_file('ajay2','ajay2166962224743.jpeg'); 
        echo"<img src='".$file_upload."'>";
       //echo url('assets/admin/js/script.js');
        //echo "<pre>";print_r($file_upload);
   }
}