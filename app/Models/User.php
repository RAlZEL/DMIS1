<?php

namespace App\Models;

use App\Models\UserRole;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Admin\EMS\Employee;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin\AdminPanel\Role\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

   public function getPictureAttribute($value) {
        if ($value) {
            return asset('back/dist/img/employee/'.$value);
        }
        else {
            return asset('back/dist/img/employee/user.png');
        }
   }

   public function Employee() {
    return $this->belongsTo(Employee::class,'email','email');
   }

   public function Role() {

   
    // return $this->hasManyThrough('App\Models\Admin\AdminPanel\Role\Role', 'App\Models\UserRole');

    return $this->hasManyThrough(
        'App\Models\Admin\AdminPanel\Role\Role',
        'App\Models\UserRole',
        'userid', 
        'id',
        'id',
        'roleid'
    );


   }

    /**
     * Check if user has a specific role
     */
    public function hasRole($roleName)
    {
        return $this->Role()->where('rolename', $roleName)->exists();
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            return $this->Role()->whereIn('rolename', $roles)->exists();
        }
        return $this->hasRole($roles);
    }

    /**
     * Get all role names for this user
     */
    public function getRoleNames()
    {
        return $this->Role()->pluck('rolename')->toArray();
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->hasRole('Admin') || $this->hasRole('admin');
    }

    /**
     * Check if user is regular user
     */
    public function isUser()
    {
        return $this->hasRole('User') || $this->hasRole('user');
    }

    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('email','like',$term)
                    ->orwhere('username','like',$term)
                    ->orwhere('is_enable','like',$term)
                    ;
        });
    }
}
