<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'email', 'id',
    ];

    public $timestamps = false;

    protected $filterable = [
        'email', 'id',
    ];

    protected $fillable = ['email'];
}
