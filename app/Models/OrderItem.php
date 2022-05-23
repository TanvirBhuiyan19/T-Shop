<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    //This field is reverse of $fillable
    protected $guarded = [];
    
    public function product() {
        return $this->belongsTo('App\Models\Product','product_id');
    }
    
}
