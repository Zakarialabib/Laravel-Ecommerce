<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id', 'title', 'slug', 'details', 'meta_title', 'meta_description', 'language_id', 'photo',
    ];

    protected $filterable = [
        'id', 'title', 'slug', 'details', 'meta_title', 'meta_description', 'language_id', 'photo',
    ];

    protected $fillable = [
        'title', 'slug', 'details', 'meta_title', 'meta_description', 'language_id', 'photo',
    ];
}
