<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;


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
}
