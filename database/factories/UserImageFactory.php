<?php

namespace Database\Factories;

use App\Models\UserImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserImage>
 */
class UserImageFactory extends Factory
{

    public function definition(): array
    {
        return [
            'image' => fake()->imageUrl(),
        ];
    }

}
