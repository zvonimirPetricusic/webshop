<?php
// database/factories/CategoryFactory.php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'parent_id' => null,
            'description' => $this->faker->sentence,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            if ($category->parent_id === null) {
                $levelOne = Category::factory()->create(['parent_id' => $category->id]);
                $levelTwo = Category::factory()->create(['parent_id' => $levelOne->id]);
            }
        });
    }
}
