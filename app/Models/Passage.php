<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passage extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'words_count'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
