<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Registration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->firstNameMale(),
            'phone' => $this->faker->numerify('03##-#######'),
            'dob' => now(),
            'bform' => $this->faker->numerify('3####-#######-#'),
            'bise_id' => $this->faker->numberBetween($min = 1, $max = 4),
            'passyear' => $this->faker->numberBetween($min = 2018, $max = 2021),
            'rollno' => $this->faker->unique()->numerify('####'),
            'marks' => $this->faker->numberBetween($min = 600, $max = 1000),
            'group_id' => $this->faker->numberBetween($min = 1, $max = 4),
            'createdat' => date('Y-m-d'),
        ];
    }
}