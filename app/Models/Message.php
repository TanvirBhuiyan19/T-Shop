<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    //This field is reverse of $fillable
    protected $guarded = [];

    
    public function user(){
        return $this->belongsTo(User::class,'sender_id'); //user_id
      }
  
      public function product(){
        return $this->belongsTo(Product::class); 
      }

      
    public function sender(){
      return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver(){
      return $this->belongsTo(User::class,'receiver_id');
    }

    
}
