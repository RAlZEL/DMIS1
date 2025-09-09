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
