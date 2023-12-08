<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";

    protected $fillable = ['name', 'deadline', 'weight', 'weight_value'];

    // Relationships
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
