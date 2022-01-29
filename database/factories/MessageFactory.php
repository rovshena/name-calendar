<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->freeEmail,
            'phone' => $this->faker->e164PhoneNumber,
            'content' => $this->faker->paragraphs(20, true),
            'is_read' => $this->faker->numberBetween(0,1),
            'created_at' => $this->faker->dateTimeThisMonth('now', config('app.timezone'))
        ];
    }

    public function unread()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_read' => 0,
            ];
        });
    }
}
