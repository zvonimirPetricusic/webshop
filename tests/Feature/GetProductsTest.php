<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_products(): void
    {
        $response = $this->getJson('/api/products?user_id=1&price_list_id=1');
    
        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'status',
                    'status_code',
                    'data' => [
                        'product_data' => [
                            '*' => [
                                'sku',
                                'title',
                                'description',
                                'price',
                                'created_at',
                                'updated_at',
                                'effective_price'
                            ]
                        ],
                        'current_page',
                        'last_page',
                        'per_page',
                        'total',
                        'prev_page_url',
                        'next_page_url'
                    ],
                    'message'
                ]);
    }
}
