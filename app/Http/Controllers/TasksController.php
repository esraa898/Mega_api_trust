<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddTaskRequest;
use App\Http\traits\ApiResponceTrait;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{

    use ApiResponceTrait;
    public function index(){

      $tasks= task::where('user_id',Auth::user()->id)->get();
      
      return $this->apiResponce(200,'user Tasks',null,$tasks);
  
    }

    public function create(Request $request){

      
    
        $validation= validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required|max:250',
            'priority'=>'required',
            'state'=>'required',
            'attachement'=> 'mimes:pdf,jpeg,png,jpg',
            
        ]); 
   
if ($validation->fails()){
    return $this->apiResponce(400,'validation Error',$validation->errors());
}




      $task=  task::create([
          'title'=>$request->title,
          'description'=>$request->description,
          'priority'=>$request->priority,
          'state'=>$request->state,
          'attachement'=> $request->file('attachement')->store('attachements'),
          'period'=>$request->period,
          'user_id'=>Auth::user()->id,
        ]);
      
        
        return $this->apiResponce(200,'task added succesfully',null,$task);

    }
   
    public function update( Request $request,$id){

        
        $task= task::find($id);
      
        $validation= validator::make($request->all(),[
            'id'=>'exists:tasks,id',
            'title'=>'required',
            'description'=>'required|max:250',
            'priority'=>'required',
            'state'=>'required',
            'attachement'=> 'mimes:pdf,jpeg,png,jpg',
            
        ]);
if ($validation->fails()){
    return $this->apiResponce(400,'validation Error',$validation->errors());
}

     
     $task->update([
        'title'=>$request->title,
        'description'=>$request->description,
        'priority'=>$request->priority,
        'state'=>$request->state,
        'attachement'=>$request->file('attachement')->store('attachements'),
        'period'=>$request->period,
        'user_id'=>Auth::user()->id,

     ]);

     return $this->apiResponce(200,'task updated succesfully',null,$task);

    }
    public function delete($id){
        $task= task::find($id);
        $validation= validator([
            'id'=>'exists:tasks,id',
        ]);
if ($validation->fails()){
    return $this->apiResponce(400,'validation Error',$validation->errors());
}

     
        $task->delete();
        return $this->apiResponce(200,'task deleted succesfully',null);
    }

    public function downloadfile($id,$filename){

        $path=public_path('Attachements/'.$id.'/'.$filename);
        return response()->download($path);

    }
}
