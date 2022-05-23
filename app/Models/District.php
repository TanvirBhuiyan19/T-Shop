<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    
    //This field is reverse of $fillable
    protected $guarded = [];
    
    
    public function division() {
        return $this->belongsTo('App\Models\Division','division_id');
    }
    
    
}
