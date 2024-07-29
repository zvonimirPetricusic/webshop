<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_order(): void
    {
        $response = $this->postJson('/api/orders?user_id=1&price_list_id=1', [
            'products' => [
                [
                    'sku' => 'SKU-03781',
                    'quantity' => 1
                ],
                [
                    'sku' => 'SKU-04598',
                    'quantity' => 2
                ]
            ]
        ]);

        $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Order created successfully!'
        ])
        ->assertJsonStructure([
            'status',
            'status_code',
            'data' => [
                'user_id',
                'total_price',
                'updated_at',
                'created_at',
                'id'
            ],
            'message'
        ]);

    }
}
