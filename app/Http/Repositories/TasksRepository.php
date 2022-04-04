<?php

namespace App\Http\Repositories;

use App\Models\task;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\ApiResponceTrait;
use App\Http\Interfaces\TasksInterface;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class TasksRepository implements TasksInterface
{

    use ApiResponceTrait;
    public function index()
    {
        $tasks = task::where('user_id', Auth::user()->id)->get();
        return $this->apiResponce(200, 'user Tasks', null, $tasks);
    }


    public function taskDetails($id){
        $validation = validator([
            'id' => 'exists:tasks,id',
        ]);
        if ($validation->fails()) {
            return $this->apiResponce(400, 'validation Error', $validation->errors());
        }  
             $task = task::find($id);
           
            
             
       return $this->apiResponce(200, 'task details', null, $task);
    }
    public function create($request)
    {
       
        $task =  task::create($request->validated());
        return $this->apiResponce(200, 'task added succesfully', null, $task);
    }

    public function update($request, $id)
    {
        $task = task::find($id); 
        $task->update($request->validated());
        return $this->apiResponce(200, 'task updated succesfully', null, $task);
    }
    public function delete($id)
    {
        $task = task::find($id);
        $validation = validator([
            'id' => 'exists:tasks,id',
        ]);
        if ($validation->fails()) {
            return $this->apiResponce(400, 'validation Error', $validation->errors());
        }  
        $filename=$task->attachement;
      
       if(Storage::exists($filename)){
        
        unlink(storage_path('app/'.$filename));
       }
        $task->delete();
        return $this->apiResponce(200, 'task deleted succesfully', null);
    }
}
