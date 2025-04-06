<?php



namespace Database\Factories;



use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition () : array
    {
        // Returning the value
        return
        [
            'name'       => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ]
        ;
    }
}
