<?php

namespace App\Observers;

use App\Models\task;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    public function creating(task $task){
       

        if(request()->has('attachement')){

     $filename=request()->file('attachement')->store('attachements');
        } else {
            $filename= " ";
        }


        $task->attachement = $filename;
        $task->user_id =Auth::user()->id;
    }

    public function updating(task $task){

        if(request()->has('attachement')){

            $filename=request()->file('attachement')->store('attachements');
               } else {
                   $filename= " ";
               }
               $task->attachement =(isset($filename)) ? $filename : $task->getRawOriginal('attachement') ;
               $task->user_id =Auth::user()->id;
         
    }
}
