<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\Api\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductCollection($this->service->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return new ProductResource($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($model = $this->service->show($id)) {
            return new ProductResource($model);
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        if ($model = $this->service->update($request->validated(), $id)) {
            return new ProductResource($model);
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
