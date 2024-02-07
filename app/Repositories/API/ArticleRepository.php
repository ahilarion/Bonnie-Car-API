<?php

namespace App\Repositories\API;

use App\Models\API\Article;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class ArticleRepository
{
    /**
     * @throws Exception
     */
    public function index()
    {
        try {
            $marques = QueryBuilder::for(Article::class)
                ->allowedIncludes(Article::$allowedIncludes)
                ->paginate(10);
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if ($marques->isEmpty()) {
            throw new Exception('No marques found', Response::HTTP_NOT_FOUND);
        }

        return $marques;
    }

    /**
     * @throws Exception
     */
    public function show($uuid) : Article
    {
        try {
            $post = QueryBuilder::for(Article::class)
                ->allowedIncludes(Article::$allowedIncludes)
                ->find($uuid)
                ->first();
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if (!$post) {
            throw new Exception('Marque not found', Response::HTTP_NOT_FOUND);
        }

        return $post;
    }

    /**
     * @throws Exception
     */
    public function store(array $data) : Article
    {
        $marque = Article::create($data);

        if (!$marque) {
            throw new Exception('Marque not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $marque;
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $uuid) : Article
    {
        $article = Article::findOrFail($uuid);

        if (!$article) {
            throw new Exception('Article not found', Response::HTTP_NOT_FOUND);
        }

        $article->update($data);
        return $article;
    }

    /**
     * @throws Exception
     */
    public function destroy($uuid) : void
    {
        $article = Article::findOrFail($uuid);

        if (!$article) {
            throw new Exception('Article not found', Response::HTTP_NOT_FOUND);
        }

        $article->delete();
    }
}
