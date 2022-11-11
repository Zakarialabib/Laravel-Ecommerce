<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class FeaturedBanner extends Model
{
    use HasAdvancedFilter;
    
    const StatusInactive = 0;
    const StatusActive = 1;
    
    public $orderable = [
      'id', 'title','details','image','status','featured','language_id'
    ];

    protected $filterable = [
      'id', 'title','details','image','status','featured','language_id'
    ];

    protected $fillable = [
         'title','details','image','status','featured','link','language_id', 'product_id'
    ];

    public $timestamps = false;

    public function product()
    {
      return $this->belongsTo(Product::class);
    }

    public function language()
    {
    	return $this->belongsTo( Language::class ,'language_id');
    }  
}