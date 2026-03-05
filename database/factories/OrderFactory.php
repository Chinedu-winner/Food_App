<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'total' => $this->faker->randomFloat(2, 5, 100),
            'status' => Order::STATUS_PENDING,
            'notes' => null,
        ];
    }
}
