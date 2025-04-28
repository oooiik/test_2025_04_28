<?php

namespace App\Http\Controllers;

use App\Http\Requests\Articles\StoreArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Services\Api\ArticleService;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ArticleCollection($this->service->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        return new ArticleResource($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($model = $this->service->show($id)) {
            return new ArticleResource($model);
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        if ($model = $this->service->update($request->validated(), $id)) {
            return new ArticleResource($model);
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
