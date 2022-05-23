<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',  
    ];

    public function user(){
        return $this->hasMany('App\Models\User');
    }
    
    public function permission(){
        return $this->hasOne('App\Models\Permission');
    }
    
}
