<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => 'Durbarit_'.$this->faker->unique()->randomNumber,
            'date' => $this->faker->date($format = 'd-m-Y', $max = 'now') ,
            'employee_name' => $this->faker->name,
            'employee_type' => 'employee',
            'mobile_number' => $this->faker->numberBetween($min = 7000000, $max = 90000000),
            'email' => $this->faker->email,
            'image' => 'th_1612677637.png',
            'present_designation'=>'Employee',
            'working_hour' => $this->faker->randomDigit,
            'present_salary' => $this->faker->numberBetween($min = 12000, $max = 25000),
            'opening_balance' => $this->faker->numberBetween($min = 120000, $max = 200000),
            'balance' => $this->faker->numberBetween($min = 70000, $max = 900000),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }

}
