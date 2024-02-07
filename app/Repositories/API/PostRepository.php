<?php

namespace App\Repositories\API;

use App\Http\Requests\API\PostStoreRequest;
use App\Http\Requests\API\PostUpdateRequest;
use App\Models\API\Post;
use Exception;
use Illuminate\Database\Eloquent\Collection;
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
            $types = QueryBuilder::for(Post::class)
                ->allowedIncludes(Post::$allowedIncludes)
                ->paginate(10);
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if ($types->isEmpty()) {
            throw new Exception('No post types found', Response::HTTP_NOT_FOUND);
        }

        return $types;
    }

    /**
     * @throws Exception
     */
    public function show($type) : Post
    {
        try {
            $type = QueryBuilder::for(Post::class)
                ->allowedIncludes(Post::$allowedIncludes)
                ->where('name', $type)
                ->first();
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if (!$type) {
            throw new Exception('Vehicle type not found', Response::HTTP_NOT_FOUND);
        }

        return $type;
    }

    /**
     * @throws Exception
     */
    public function store(PostStoreRequest $data) : Post
    {
        $type = Post::create($data->all());

        if (!$type) {
            throw new Exception('Vehicle type not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $type;
    }

    /**
     * @throws Exception
     */
    public function update(PostUpdateRequest $data, $type) : Post
    {
        $type = Post::where('name', $type)->first();

        if (!$type) {
            throw new Exception('Vehicle not found', Response::HTTP_NOT_FOUND);
        }

        $type->update($data->all());

        return $type;
    }

    /**
     * @throws Exception
     */
    public function destroy($type) : void
    {
        $type = Post::where('name', $type)->first();

        if (!$type) {
            throw new Exception('Vehicle not found', Response::HTTP_NOT_FOUND);
        }

        $type->delete();
    }
}
