<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";

    protected $fillable = ['project_id', 'name', 'label_id', 'estimation', 'reality'];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function label()
    {
        return $this->belongsTo(Label::class);
    }
}
