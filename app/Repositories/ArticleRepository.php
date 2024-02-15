<?php

namespace App\Repositories;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleRepository {
    /**
     * @throws Exception
     */
    public function index()
    {
        $articles = QueryBuilder::for(Article::class)
            ->defaultSort('-created_at')
            ->paginate(10);

        if ($articles->isEmpty()) {
            throw new Exception('No articles found', 404);
        }

        return $articles;
    }

    /**
     * @throws Exception
     */
    public function show($uuid) : Article
    {
        $article = QueryBuilder::for(Article::class)
            ->find($uuid)
            ->first();

        if (!$article) {
            throw new Exception('Article not found', 404);
        }

        return $article;
    }

    /**
     * @throws Exception
     */
    public function store(ArticleStoreRequest $request) : Article
    {
        $randomName = time() . '.' . random_bytes(4) . "." . $request->image->extension();
        $request->image->storeAs('public/images', $randomName);
        $request->merge(['image' => $randomName]);

        $article = Article::create($request->validated());

        if (!$article) {
            throw new Exception('Article not created', 500);
        }

        return $article;
    }

    /**
     * @throws Exception
     */
    public function update(ArticleUpdateRequest $request, $uuid) : Article
    {
        $article = Article::find($uuid);

        if (!$article) {
            throw new Exception('Article not found', 404);
        }

        if ($request->hasFile('image')) {
            $path = storage_path('app/public/images/' . $article->image);

            if (file_exists($path)) {
                unlink($path);
            } else {
                throw new Exception('Image not found', 404);
            }

            $randomName = time() . '.' . random_bytes(4) . "." . $request->image->extension();
            $request->image->storeAs('public/images', $randomName);
            $request->merge(['image' => $randomName]);
        }

        $article->update($request);

        return $article;
    }

    /**
     * @throws Exception
     */
    public function destroy($uuid): void
    {
        $article = Article::find($uuid);

        if (!$article) {
            throw new Exception('Article not found', 404);
        }

        $path = storage_path('app/public/images/' . $article->image);

        if (file_exists($path)) {
            unlink($path);
        } else {
            throw new Exception('Image not found', 404);
        }

        $article->delete();
    }
}
