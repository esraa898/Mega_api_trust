<?php 
namespace App\Http\Interfaces;

interface TasksInterface{
    public function index();
    public function taskDetails($id);
    public function create( $request);
    public function update(  $request,$id);
    public function delete($id);


}