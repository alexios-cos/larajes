<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $offset = ((int) $request->get('offset')) ?? 0;
        $limit = ((int) $request->get('limit')) ?? 50;

        // No cursor pagination because there is a known low number of rows
        $users = User::withCount('images')
            ->orderBy('images_count', 'desc')
            ->limit($limit + 1)
            ->offset($offset)
            ->get();

        return response()->json([
            'meta' => [
                'has_next_page' => $users->count() > $limit,
            ],
            'data' => $users->slice(0, $limit),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'images' => 'required|array|min:1|max:15',
                'images.*.image' => 'required|max:255',
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ], 422);
        }

        /** @var User $user */
        $user = User::create([
            'name' => $data['name'],
            'city' => $data['city'],
        ]);

        $user->images()->createMany(array_map(fn(array $image) => [
            'image' => $image['image'],
        ], $data['images']));

        return response()->json($user, 201);
    }

}
