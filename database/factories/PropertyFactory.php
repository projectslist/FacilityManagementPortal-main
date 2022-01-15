<?php

namespace Database\Factories;

use App\Models\property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $propertyNames = $this->faker->word(2);
        return [
            'property_name' => $propertyNames,


        ];
    }
}
