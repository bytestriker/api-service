<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'banner_id' => $this->faker->word,
        'small_image' => $this->faker->word,
        'cover_image' => $this->faker->word,
        'title' => $this->faker->word,
        'body' => $this->faker->word,
        'caption' => $this->faker->word,
        'link' => $this->faker->word,
        'is_published' => $this->faker->word,
        'date_from' => $this->faker->word,
        'date_to' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
