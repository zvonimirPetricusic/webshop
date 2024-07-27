<?php

// database/factories/PriceListFactory.php

namespace Database\Factories;

use App\Models\ContractList;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractListFactory extends Factory
{
    protected $model = ContractList::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
        ];
    }
}
