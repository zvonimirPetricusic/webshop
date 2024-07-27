<?php

// database/factories/PriceListFactory.php

namespace Database\Factories;

use App\Models\PriceList;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceListFactory extends Factory
{
    protected $model = PriceList::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
        ];
    }
}
