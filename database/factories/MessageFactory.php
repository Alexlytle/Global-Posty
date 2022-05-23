<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Message::class;

    public function definition()
    {

        // 'from' => $this->faker->unique(true)->numberBetween(1,15),
        // 'to' => $this->faker->unique(true)->numberBetween(1,15),
        return [
            'from' => $this->faker->numberBetween(1,15),
            'to' => $this->faker->numberBetween(1,15),
            'text' =>$this->faker->sentence,
           
        ];
    }
}
