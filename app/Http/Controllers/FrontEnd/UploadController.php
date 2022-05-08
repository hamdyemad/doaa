<?php


namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

use App\Models\Tmp;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;


use Illuminate\Support\Facades\Validator;



class UploadController extends Controller

{
  
  public function store(Request $request){
    
    if($request->hasFile('voice1')){
      
      $file = $request->file('voice1');
      $filename = $file->getClientOriginalName();
      $folder = uniqid().'-' . now()->timestamp;

      $file->storeAs('voices/tmp/'.$folder,$filename);
      Tmp::create([
        'folder' => $folder,
        'filename' => $filename
      ]);
      
      return $filename;
     
    }

    return '';
    
  }
  
}