<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function __construct(protected Article $model)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->model->query()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($data)
    {
        return $this->model->query()->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->model->query()->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, string $id)
    {
        if ($model = $this->model->query()->find($id)) {
            return $model->update($data);
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($model = $this->model->query()->find($id)) {
            $model->delete();
            return true;
        }
        return false;
    }
}