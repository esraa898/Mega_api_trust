<?php

namespace App\Observers;

use App\Models\task;
use App\Http\traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskObserver
{
    use ImageTrait;
    public function creating(task $task){
       

        if(request()->has('attachement')){

     $file=request()->file('attachement');
    $filename= $this->storeImage($file);  
   
    
        } 


        $task->attachement = $filename;
        $task->user_id =Auth::user()->id;
    }

    public function updating(task $task){

        if(request()->has('attachement')){
           $file=request()->file('attachement');
            $filename= $this->storeImage($file); 
          }
               $task->attachement =(isset($filename)) ? $filename : $task->getRawOriginal('attachement') ;
               $task->user_id =Auth::user()->id;
         
    
}
}
