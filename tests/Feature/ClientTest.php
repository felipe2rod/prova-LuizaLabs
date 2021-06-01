<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_get()
    {
        $Client = Client::factory()->create();

        $response = $this->get('/api/clients');

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'cpf',
                        'email',
                        'sex'
                    ]
                ]
            ]);

    }

    public function test_post_success()
    {
        $clientData = [
            'name' => 'Felipe Rodrigues Fernandes',
            'email' => 'felipe2rod@gmail.com',
            'cpf' => '111.111.111-11',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => 'Sucefully created'
        ]);
    }
}
