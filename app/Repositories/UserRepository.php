<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository {
    public function me()
    {
        return auth()->user();
    }

    /**
     * @throws \Exception
     */
    public function index()
    {
        return QueryBuilder::for(User::class)
            ->paginate(10);
    }

    public function show(string $uuid): User
    {
        return QueryBuilder::for(User::class)
            ->find($uuid)
            ->first();
    }

    public function update(array $data, string $uuid): User
    {
        $user = User::find($uuid);
        $user->update($data);
        return $user;
    }

    public function destroy(string $uuid): bool
    {
        return User::destroy($uuid);
    }
}
