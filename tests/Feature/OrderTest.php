<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;

class OrderTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_all_clients()
    {
        $response = $this->get('/api/pedidos');

        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'order_date',
                        'observation',
                        'pay_method',
                        'client' => '*',
                        'items' => '*'
                    ]
                ]
            ]);

    }

    public function test_show_order(){

        $Client = Client::factory()->create();

        $Order = Order::factory()->for($Client)->create();

        $response = $this->get("/api/pedidos/{$Order->id}");

        $response
            ->assertStatus(JsonResponse::HTTP_CREATED);
    }

    public function test_post_success()
    {
        $Client = Client::factory()->create();
        $Product = Product::factory()->create();

        $orderData = [
            'order_date' => date('Y-m-d'),
            'observation'=> "lorem ipsum",
            'pay_method' => 'credit_card',
            'client_id' => $Client->id,
            'items' => [
                [
                    'quantity' => 1,
                    'product_id' => $Product->id
                ],
                [
                    'quantity' => 4,
                    'product_id' => $Product->id
                ]
            ]
        ];

         $response = $this->post('/api/pedidos',$orderData);
         $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => 'Successfully created'
        ]);
    }
}
