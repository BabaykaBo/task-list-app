<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $fillable = ['text'];

    public $timestamps = false;

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
