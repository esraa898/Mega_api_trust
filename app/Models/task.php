<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class task extends Model
{
    use HasFactory;
    protected  $table= 'tasks';

    protected $fillable=['title','description','priority','state','attachement','period','user_id'];


  public function user(){
      return $this->belongsTo(User::class);
  }


  public static function rules(){

    return [
    'title' => 'required',
    'description' => 'required|max:250',
    'priority' => 'required',
    'state' => 'required',
    'attachement' => 'nullable|mimes:pdf,jpeg,png,jpg',
    ];

  }

  
  
  
  
  
}
