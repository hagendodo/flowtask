<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = "members";

    protected $fillable = ['nowa', 'nama', 'nim', 'harapan', 'bidang'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now()->setTimezone('Asia/Jakarta');
        });

        static::updating(function ($model) {
            $model->updated_at = now()->setTimezone('Asia/Jakarta');
        });
    }
}
