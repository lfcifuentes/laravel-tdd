<?php

namespace Database\Factories;

use App\Models\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class RepositoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Repository::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::Factory(),
			'url' => $this->faker->url,
			'description' => $this->faker->text,
        ];
    }
}
