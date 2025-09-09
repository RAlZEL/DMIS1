<?php

namespace App\Models;

use App\Models\Admin\AdminPanel\Role\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Model
{
    protected $table = "user_roles";    
    
    use HasFactory;

    protected $guarded = [];

    public function User() {
        return $this->belongsTo(User::class, 'userid','id');
    }

    public function Role() {
        return $this->belongsTo(Role::class, 'roleid','id');
    }

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->whereHas('user', function($query) use ($term) {
                $query->where('username','like', $term);
            })
            ->orwhereHas('user', function($query) use ($term) {
                $query->where('email','like', $term);     
            })
            ->orwhereHas('role', function($query) use ($term) {
                $query->where('rolename','like', $term);     
            })
            // ->orwhereHas('office', function($query) use ($term) {
            //     $query->where('office','like', $term);     
            // });
            ;
        });
    }
}
