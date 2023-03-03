<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    use HasAdvancedFilter;

    public $table = 'permissions';

    public $orderable = [
        'id',
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    public $filterable = [
        'id',
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Determine if the permission belongs to the role.
     *
     * @param  mixed  $role
     *
     * @return bool
     */
    public function inRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return (bool) $role->intersect($this->roles)->count();
    }
}
