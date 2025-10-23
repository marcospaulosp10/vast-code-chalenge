<?php

namespace App\Services;

use App\Models\Passage;

class PassageService
{
    public function random(): Passage
    {
        return Passage::inRandomOrder()->first();
    }
}
