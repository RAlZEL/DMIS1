<?php

namespace App\Models\Task;

use App\Models\User;
use App\Models\Task\Comment;
use App\Models\Admin\EMS\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    protected $table = "task";    
    
    use HasFactory;

    protected $guarded = [];

    public function AssignedBy() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function Comments() {
        return $this->hasMany(Comment::class, 'task_id','id');
    }

    public function AssignedTo() {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }

    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('task','like',$term)
                    ->orwhere('remarks','like',$term)
                    ->orwhere('start_date','like',$term)
                    ->orwhere('due_date','like',$term);
                    
         
        });
    }

}
