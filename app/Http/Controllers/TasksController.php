<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TasksInterface;
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

    public function create(Request $request)
    {

        return   $this->TasksInterface->create($request);
    }

    public function update(Request $request, $id)
    {

        return   $this->TasksInterface->update($request, $id);
    }
    public function delete($id)
    {
        return   $this->TasksInterface->delete($id);
    }
}
