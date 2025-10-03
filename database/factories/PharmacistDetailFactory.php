<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PharmacistDetail>
 */
class PharmacistDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => User::factory(),
            'license_number' => fake()->unique()->bothify('LIC-#####'),
            'license_expiry' => fake()->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
            'specialization' => fake()->randomElement(['Cardiologist', 'Dermatologist', 'Endocrinologist', 'Gastroenterologist', 'Neurologist', 'Pediatrician', 'Psychiatrist', 'Radiologist', 'Surgeon', 'Urologist', 'Obstetrician/Gynecologist (OB/GYN)']),
            'is_active' => fake()->boolean(80), // 80% chance of being true
        ];
    }
}
