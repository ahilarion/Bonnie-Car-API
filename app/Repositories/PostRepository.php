<?php

namespace App\Repositories;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Vehicle;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Random\RandomException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class PostRepository {
    /**
     * @throws Exception
     */
    public function index() {
        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters([
                'title',
                'content',
                AllowedFilter::exact('user_uuid'),
            ])
            ->allowedSorts([
                'title',
                'content',
                'created_at',
                'updated_at',
            ])
            ->allowedIncludes([
                'user',
                'vehicle',
            ])
            ->paginate(10);

        if ($posts->isEmpty()) {
            throw new Exception('No posts found', Response::HTTP_NOT_FOUND);
        }

        return $posts;
    }

    /**
     * @throws Exception
     */
    public function show($uuid) {
        $post = QueryBuilder::for(Post::class)
            ->allowedIncludes([
                'user',
                'vehicle',
            ])
            ->find($uuid);

        if (!$post) {
            throw new Exception('Post not found', Response::HTTP_NOT_FOUND);
        }

        return $post;
    }

    /**
     * @throws RandomException
     * @throws Exception
     */
        public function store(PostStoreRequest $request)
    {
        $vehicle = Vehicle::create([
            $request->constructor,
            $request->model,
            $request->is_two_wheeled,
            $request->original_price,
            $request->type,
            $request->energy_source,
            $request->transmission,
            $request->cylinder_capacity,
            $request->power,
            $request->torque,
            $request->year_of_manufacture,
            $request->production_year,
            $request->circulation_date,
            $request->technical_revision,
            $request->number_of_owners,
            $request->kilometers,
            $request->color,
            $request->number_of_doors,
            $request->seats,
            $request->vehicle_length,
            $request->condition,
            $request->description,
        ]);

        if (!$vehicle) {
            throw new Exception('Vehicle not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $images = [];

        foreach ($request->images as $image) {
            $randomName = time() . '.' . random_bytes(4) . "." . $image->extension();
            $image->storeAs('public/images', $randomName);
            $images[] = $randomName;
        }

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'images' => $images,
            'user_uuid' => $request->user_uuid,
            'vehicle_uuid' => $vehicle->uuid,
        ]);

        if (!$post) {
            throw new Exception('Post not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $post;
    }

    /**
     * @throws Exception
     */
    public function update(PostUpdateRequest $request, $uuid) {
        $post = Post::find($uuid);

        if (!$post) {
            throw new Exception('Post not found', Response::HTTP_NOT_FOUND);
        }

        $vehicle = $post->vehicle;

        if (!$vehicle) {
            throw new Exception('Vehicle not found', Response::HTTP_NOT_FOUND);
        }

        $vehicle->update([
            $request->constructor,
            $request->model,
            $request->is_two_wheeled,
            $request->original_price,
            $request->type,
            $request->energy_source,
            $request->transmission,
            $request->cylinder_capacity,
            $request->power,
            $request->torque,
            $request->year_of_manufacture,
            $request->production_year,
            $request->circulation_date,
            $request->technical_revision,
            $request->number_of_owners,
            $request->kilometers,
            $request->color,
            $request->number_of_doors,
            $request->seats,
            $request->vehicle_length,
            $request->condition,
            $request->description,
        ]);

        $images = $post->images;

        if ($request->hasFile('images')) {
            foreach ($images as $image) {
                $path = storage_path('app/public/images/' . $image);

                if (file_exists($path)) {
                    unlink($path);
                } else {
                    throw new Exception('Image not found', Response::HTTP_NOT_FOUND);
                }
            }

            $images = [];

            foreach ($request->images as $image) {
                $randomName = time() . '.' . random_bytes(4) . "." . $image->extension();
                $image->storeAs('public/images', $randomName);
                $images[] = $randomName;
            }
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'images' => $images,
            'user_uuid' => $request->user_uuid,
            'vehicle_uuid' => $vehicle->uuid,
        ]);

        return $post;
    }

    /**
     * @throws Exception
     */
    public function destroy($uuid): void
    {
        $post = Post::find($uuid);

        if (!$post) {
            throw new Exception('Post not found', Response::HTTP_NOT_FOUND);
        }

        $vehicle = $post->vehicle;

        if (!$vehicle) {
            throw new Exception('Vehicle not found', Response::HTTP_NOT_FOUND);
        }

        $images = $post->images;

        foreach ($images as $image) {
            $path = storage_path('app/public/images/' . $image);

            if (file_exists($path)) {
                unlink($path);
            } else {
                throw new Exception('Image not found', Response::HTTP_NOT_FOUND);
            }
        }

        $post->delete();
        $vehicle->delete();
    }

     public function lastMoto(): Collection|array
     {
        return QueryBuilder::for(Post::class)
            ->with('vehicle')
            ->where('vehicle.type', 'moto')
            ->latest()
            ->limit(5)
            ->get();
    }

    public function lastCar(): Collection|array
    {
        return QueryBuilder::for(Post::class)
            ->with('vehicle')
            ->where('vehicle.type', 'car')
            ->latest()
            ->limit(5)
            ->get();
    }
}
