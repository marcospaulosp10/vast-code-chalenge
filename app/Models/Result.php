<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'passage_id',
        'name',
        'wpm',
        'accuracy',
        'duration_ms',
    ];

    public function passage()
    {
        return $this->belongsTo(Passage::class);
    }
}
