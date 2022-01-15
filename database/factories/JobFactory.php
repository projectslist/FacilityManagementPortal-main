<?php

namespace Database\Factories;

use App\Models\Job;

use App\Models\property;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        //$old_user = DB::connection('old')->table('users')->get();
//        $property_names = property::latest()->get();
//
//        $fullname =$this->faker->firstName() . " " . $this->faker->lastName();
//
//        $result =[];
//        foreach ($property_names[1] as $value) {
//
//            array_push($result,$value);
//        }

                return [
            'summary' => $this->faker->paragraph(1),
            'description' => $this->faker->paragraph(5),
            'status' => 'open',
            'property_id' => $this->faker->numberBetween(1,10),
            'user_id' => $this->faker->numberBetween(1,10),
        ];
}


        //return $property_names;


//        //$property_id = $this->faker->numberBetween(1,10);
//        return [
//            'summary' => $this->faker->paragraph(1),
//            'description' => $this->faker->paragraph(5),
//            'status' => 'open',
////            'property' => $this->faker->word(2),
//            'property' =>$property_names,
//            'raised_by' => $fullname,
//        ];


}
