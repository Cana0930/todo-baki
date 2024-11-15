<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Task モデルと Color モデルのリレーション定義
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}