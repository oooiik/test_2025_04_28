<?php

namespace app\Services\Api;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(protected ProductRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($data)
    {
        if (empty($data['barcode'])) {
            $data['barcode'] = Product::factory()->make()['barcode'];
        }
        return $this->repository->store($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, string $id)
    {
        if (!($fail = $this->repository->update($data, $id))) {
            return $fail;
        }
        return $this->repository->show($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->repository->destroy($id);
    }
}