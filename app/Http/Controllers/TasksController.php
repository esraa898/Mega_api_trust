<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TasksInterface;
use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Http\Request;


class TasksController extends Controller
{

    protected $TasksInterface;

    public function __construct(TasksInterface $tasksInterface)
    {
        $this->TasksInterface = $tasksInterface;
    }
    public function index()
    {
        return   $this->TasksInterface->index();
    }
    public function taskDetails($id){
        return $this->TasksInterface->taskDetails($id);

    }

    public function create(AddTaskRequest $request)
    {

        return   $this->TasksInterface->create($request);
    }

    public function update(UpdateRequest $request, $id)
    {

        return   $this->TasksInterface->update($request, $id);
    }
    public function delete($id)
    {
        return   $this->TasksInterface->delete($id);
    }
}
