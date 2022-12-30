<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    public const ROLE_ADMIN = 'ADMIN';

    public const ROLE_CLIENT = 'CLIENT';

    public $table = 'roles';

    public $orderable = [
        'id',
        'name',
    ];

    public $filterable = [
        'id',
        'name',
        'permissions.title',
    ];

    protected $fillable = [
        'name',
        'guard_name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    // syncPermissions
    public function syncPermissions($permissions)
    {
        $this->permissions()->sync($permissions);
    }
}
