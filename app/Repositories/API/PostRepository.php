<?php

namespace App\Repositories\API;

use App\Http\Requests\API\PostStoreRequest;
use App\Http\Requests\API\PostUpdateRequest;
use App\Models\API\Post;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class PostRepository
{
    /**
     * @throws Exception
     */
    public function index()
    {
        try {
            $posts = QueryBuilder::for(Post::class)
                ->allowedIncludes(Post::$allowedIncludes)
                ->paginate(10);
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if ($posts->isEmpty()) {
            throw new Exception('No post posts found', Response::HTTP_NOT_FOUND);
        }

        return $posts;
    }

    /**
     * @throws Exception
     */
    public function show($post) : Post
    {
        try {
            $post = QueryBuilder::for(Post::class)
                ->allowedIncludes(Post::$allowedIncludes)
                ->where('uuid', $post)
                ->first();
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if (!$post) {
            throw new Exception('Post post not found', Response::HTTP_NOT_FOUND);
        }

        return $post;
    }

    /**
     * @throws Exception
     */
    public function store(PostStoreRequest $data) : Post
    {
        $user = Auth::user();

        $model = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'images' => json_encode($data['images']),
            'price' => $data['price'],
            'kilometer' => $data['kilometer'],
            'user_id' => $user->id
        ]);

        if (!$model) {
            throw new Exception('Failed to create model', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $model;
    }

    /**
     * @throws Exception
     */
    public function update(PostUpdateRequest $data, $post) : Post
    {
        $post = Post::where('uuid', $post)->first();

        if (!$post) {
            throw new Exception('Post not found', Response::HTTP_NOT_FOUND);
        }

        $post->update($data->all());

        return $post;
    }

    /**
     * @throws Exception
     */
    public function destroy($post) : void
    {
        $post = Post::where('uuid', $post)->first();

        if (!$post) {
            throw new Exception('Post not found', Response::HTTP_NOT_FOUND);
        }

        $post->delete();
    }
}
