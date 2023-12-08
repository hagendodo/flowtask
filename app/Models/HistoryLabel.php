<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLabel extends Model
{
    use HasFactory;

    protected $table = "history_labels";

    protected $fillable = ['label_id', 'estimation', 'reality'];
}
