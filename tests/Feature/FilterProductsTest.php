<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_filter_products(): void
    {
        $response = $this->getJson('/api/products/filter?user_id=1&price_list_id=1&title=nostrum&category_id=1&min_price=50&max_price=100&sort_by=price&sort_direction=asc');

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
