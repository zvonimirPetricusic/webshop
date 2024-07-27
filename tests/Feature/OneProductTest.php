<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OneProductTest extends TestCase
{

    public function test_one_product(): void
    {
        $response = $this->getJson('/api/products/SKU-03781?user_id=1&price_list_id=1');
    
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'status_code',
                     'data' => [
                         'sku',
                         'title',
                         'description',
                         'price',
                         'created_at',
                         'updated_at',
                         'effective_price'
                     ],
                     'message'
                 ]);
    }
    
}
