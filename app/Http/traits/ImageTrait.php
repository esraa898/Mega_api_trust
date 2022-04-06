<?php
namespace App\Http\traits;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

trait ImageTrait{

    public function storeImage($file,$oldfile=null){
        $fileUrl= 'attachements';
       
      $path=  Storage::disk('s3')->put($fileUrl, $file);
      if(Storage::disk('s3')->exists($oldfile)){

        Storage::disk('s3')->delete($oldfile);
      }
    return $path;
    
       
    }

}