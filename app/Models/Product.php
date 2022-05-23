<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    //This field is reverse of $fillable
    protected $guarded = [];
    
    
     public function brand() {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    
     public function category() {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    
     public function subcategory() {
        return $this->belongsTo('App\Models\Subcategory','subcategory_id');
    }
    
     public function sub_subcategory() {
        return $this->belongsTo('App\Models\SubSubcategory','sub_subcategory_id');
    }
    
}
