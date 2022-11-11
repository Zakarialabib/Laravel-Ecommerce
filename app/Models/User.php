<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Support\HasAdvancedFilter;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasAdvancedFilter, HasApiTokens,
         HasFactory, Notifiable, HasRoles;

    public $orderable = [
        'id','first_name','last_name',  'zip', 'city', 'state', 'country', 'address',
        'phone', 'email','password',
    ];

    protected $filterable = [
        'first_name','last_name',  'zip', 'city', 'state', 'country', 'address',
        'phone', 'email','password','favorite_brands'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id','first_name','last_name',  'zip', 'city', 'state', 'country', 'address',
        'phone', 'email','password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isAdmin() {
        return $this->roles->pluck('name')->contains(Role::ROLE_ADMIN);
    }
    
    public function isClient() {
        return $this->roles->pluck('name')->contains(Role::ROLE_CLIENT);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
