<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PassageService;
use App\Http\Resources\PassageResource;

class PassageController extends Controller
{
    public function __construct(protected PassageService $service) {}

    public function random()
    {
        return new PassageResource($this->service->random());
    }
}
