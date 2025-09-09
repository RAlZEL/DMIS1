<?php

namespace App\Models\Task;

use App\Models\Task\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    protected $table = "task_comment";    
    
    use HasFactory;

    protected $guarded = [];

    public function Task() {
        return $this->belongsTo(Task::class, 'task_id','id');
    }

    public function User() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
