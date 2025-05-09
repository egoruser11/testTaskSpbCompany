<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auto\IndexRequest;
use App\Http\Resources\AutoResource;
use App\Http\Services\AutoService;


class MainController extends Controller
{

    public function __construct(private AutoService $autoService)
    {

    }

    public function index(IndexRequest $request)
    {
        return response()->json(
            AutoResource::collection($this->autoService->run($request->validated())), 200);
    }
}
