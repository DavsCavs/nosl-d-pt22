<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {

        $carData = [
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Prius'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Fit'],
            'Ford' => ['Focus', 'Fusion', 'Escape', 'Mustang'],
            'Audi' => ['A3', 'A4', 'A6', 'Q5'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'GLE', 'SLK', 'CLS'],
        ];

        $brand = fake()->randomElement(array_keys($carData));
        $model = fake()->randomElement($carData[$brand]);


        return [
            'brand' => $brand,
            'model' => $model,
            'year' => fake()->numberBetween(1995, 2025),
            'engine_size' => fake()->randomElement(['1.0L', '1.5L', '2.0L', '2.5L', '3.0L', '4.0L']),
            'mileage' => fake()->numberBetween(0, 500000),
            'price' => fake()->numberBetween(1000, 13000),
            'url' => fake()->unique()->url() . "cars/{$brand}/{$model}/" . fake()->uuid(),
        ];
    }
}
