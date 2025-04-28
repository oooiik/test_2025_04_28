<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Services\Api\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CategoryCollection($this->service->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($model = $this->service->show($id)) {
            return new CategoryResource($model);
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        if ($model = $this->service->update($request->validated(), $id)) {
            return new CategoryResource($model);
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->service->destroy($id)) return abort(404);
    }
}
