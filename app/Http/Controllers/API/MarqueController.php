<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\MarqueResource;
use App\Repositories\API\MarqueRepository;

class MarqueController extends Controller
{
    private MarqueRepository $marqueRepository;
    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function index()
    {
        try {
            $data = $this->marqueRepository->index();

            return MarqueResource::collection($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function show($marque)
    {
        try {
            $data = $this->marqueRepository->show($marque);
            return new MarqueResource($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }
}
