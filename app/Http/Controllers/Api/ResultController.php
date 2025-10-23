<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResultRequest;
use App\Services\ResultService;

class ResultController extends Controller
{
    public function __construct(protected ResultService $service) {}

    public function store(StoreResultRequest $request)
    {
        $data = $this->service->store($request->validated());
        return response()->json($data, 201);
    }
}
