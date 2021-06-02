<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'order_date' => $this->faker->date(),
           'observation' => $this->faker->text(),
           'pay_method' => $this->faker->randomElement(['money','credit_card','check']),
        ];
    }
}
