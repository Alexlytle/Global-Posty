<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Like::class;
    public function definition()
    {
        return [
            'user_id'=>$this->faker->unique(true)->numberBetween(1,10),
            'post_id' =>$this->faker->numberBetween(1,10),
        ];
    }
}
