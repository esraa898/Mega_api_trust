<?php

namespace App\Http\Repositories;

use App\Models\task;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\ApiResponceTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Interfaces\TasksInterface;

class TasksRepository implements TasksInterface
{

    use ApiResponceTrait;
    public function index()
    {

        $tasks = task::where('user_id', Auth::user()->id)->get();

        return $this->apiResponce(200, 'user Tasks', null, $tasks);
    }

    public function create($request)
    {



        $validation = validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required|max:250',
            'priority' => 'required',
            'state' => 'required',
            'attachement' => 'mimes:pdf,jpeg,png,jpg',

        ]);

        if ($validation->fails()) {
            return $this->apiResponce(400, 'validation Error', $validation->errors());
        }


          $filename= $request->file('attachement')->store('attachements');

        $task =  task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'state' => $request->state,
            'attachement' => $filename,
            'period' => $request->period,
            'user_id' => Auth::user()->id,
        ]);


        return $this->apiResponce(200, 'task added succesfully', null, $task);
    }

    public function update($request, $id)
    {


        $task = task::find($id);

        $validation = validator::make($request->all(), [
            'id' => 'exists:tasks,id',
            'title' => 'required',
            'description' => 'required|max:250',
            'priority' => 'required',
            'state' => 'required',
            'attachement' => 'mimes:pdf,jpeg,png,jpg',

        ]);
        if ($validation->fails()) {
            return $this->apiResponce(400, 'validation Error', $validation->errors());
        }

  
        if($request->has('attachement')){
            $filename= $request->file('attachement')->store('attachements');}

        
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'state' => $request->state,
            
            'attachement' => (isset($filename)) ? $filename : $task->getRawOriginal('attachement'),
            'period' => $request->period,
            'user_id' => Auth::user()->id,

        ]);

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


        $task->delete();
        return $this->apiResponce(200, 'task deleted succesfully', null);
    }
}
