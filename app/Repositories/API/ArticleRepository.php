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
            $article = QueryBuilder::for(Article::class)
                ->allowedIncludes(Article::$allowedIncludes)
                ->paginate(10);
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if ($article->isEmpty()) {
            throw new Exception('No article found', Response::HTTP_NOT_FOUND);
        }

        return $article;
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
            throw new Exception('Article not found', Response::HTTP_NOT_FOUND);
        }

        return $post;
    }

    /**
     * @throws Exception
     */
    public function store(array $data) : Article
    {
        try {

            $article = Article::create([
                'title' => $data['title'],
                'thumbnail' => $data['thumbnail'],
                'description' => $data['description'],
                'short_description' => $data['short_description'],
                'html_content' => $data['html_content'],
                'banner' => $data['html_content'],
                'tags' => json_encode($data['tags'])
            ]);
            $article->refresh();

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        if (!$article) {
            throw new Exception('Article not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        return $article;
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $uuid) : Article
    {
        
        try {
            $article = Article::findOrFail($uuid);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        if (!$article) {
            throw new Exception('Article not found', Response::HTTP_NOT_FOUND);
        }

        $article->update([
            'title' => $data['title'],
            'thumbnail' => $data['thumbnail'],
            'description' => $data['description'],
            'short_description' => $data['short_description'],
            'html_content' => $data['html_content'],
            'banner' => $data['html_content'],
            'tags' => json_encode($data['tags'])
        ]);
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
