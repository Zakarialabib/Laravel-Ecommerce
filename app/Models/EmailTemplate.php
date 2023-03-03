<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id', 'email_type', 'email_subject', 'email_body', 'status',
    ];

    public $filterable = [
        'id', 'email_type', 'email_subject', 'email_body', 'status',
    ];

    public $timestamps = false;

    protected $fillable = [
        'id', 'email_type', 'email_subject', 'email_body', 'status',
    ];
}
