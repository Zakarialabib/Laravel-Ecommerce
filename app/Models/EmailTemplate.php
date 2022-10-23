<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class EmailTemplate extends Model
{
    use HasAdvancedFilter;
    
    protected $fillable = [
      'id','email_type', 'email_subject', 'email_body', 'status'
    ];
 
    public $orderable = [
      'id', 'email_type', 'email_subject', 'email_body', 'status'
  ];

  public $filterable = [
    'id', 'email_type', 'email_subject', 'email_body', 'status'
  ];
  
  public $timestamps = false;
}
