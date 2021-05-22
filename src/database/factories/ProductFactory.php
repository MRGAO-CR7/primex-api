<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->randomName();
        $datetime = date('Y-m-d H:i:s');

        return [
            'code' => (string) $this->faker->randomNumber(),
            'name' => $name,
            'on_hand' => 0,
            'description' => 'description: ' . $name,
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }

    /**
     * Get a random name.
     *
     * @return string
     */
    public function randomName()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        for ($i = 0; $i < 10; $i++) {
            $randString .= $characters[rand(0, strlen($characters))];
        }
        return $randString;
    }
}
