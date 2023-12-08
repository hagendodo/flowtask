<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $table = "labels";

    protected $fillable = ['name', 'description'];

    // Relationships
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function history()
    {
        return $this->hasMany(HistoryLabel::class)->orderBy('created_at', 'desc');
    }
}
