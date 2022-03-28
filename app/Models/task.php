<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $fillable=['title','description','priority','state','attachement','period','user_id'];


  public function user(){
      return $this->belongsTo(User::class);
  }
}
