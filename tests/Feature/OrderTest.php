<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use App\Models\Order;
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

    public function test_show_client(){

        $Client = Client::factory()->create();

        $Order = Order::factory()->for($Client)->create();

        $response = $this->get("/api/pedidos/{$Order->id}");

        $response
            ->assertStatus(JsonResponse::HTTP_CREATED);
    }
}
