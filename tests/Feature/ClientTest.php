<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_get()
    {
        $Client = Client::factory()->create();

        $response = $this->get('/api/clients');

        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
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
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => 'Successfully created'
        ]);
    }

    public function test_invalid_required_name()
    {
        $clientData = [
            'name' => null,
            'email' => 'felipe1rod@gmail.com',
            'cpf' => '111.111.111-13',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'name' => ['O campo nome é obrigatório']
                ]
        ]);
    }

    public function test_invalid_type_name()
    {
        $clientData = [
            'name' => 1,
            'email' => 'felipe1rod@gmail.com',
            'cpf' => '111.111.111-13',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'name' => ['O campo nome deve ser uma string']
                ]
        ]);
    }

    public function test_invalid_max_size_name()
    {
        $clientData = [
            'name' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'email' => 'felipe1rod@gmail.com',
            'cpf' => '111.111.111-13',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'name' => ['O campo nome deve ter no maximo 45 caracteres']
                ]
        ]);
    }

    public function test_invalid_required_cpf()
     {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 'felipe1rod@gmail.com',
            'cpf' => null,
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'cpf' => ['O campo cpf é obrigatório']
                ]
        ]);
    }

    public function test_invalid_type_cpf()
    {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 'felipe1rod@gmail.com',
            'cpf' => 11111111111111,
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'cpf' => ['O campo cpf deve ser uma string']
                ]
        ]);
    }

    public function test_invalid_max_cpf()
     {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 'felipe1rod@gmail.com',
            'cpf' => '111111111111111',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'cpf' => ['O campo cpf deve ter 14 caracteres']
                ]
        ]);
    }

    public function test_invalid_min_cpf()
    {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 'felipe1rod@gmail.com',
            'cpf' => '1',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'cpf' => ['O campo cpf deve ter 14 caracteres']
                ]
        ]);
    }


    public function test_invalid_unique_cpf()
    {
        $Client = Client::factory()->create();

        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 'felipe1rod@gmail.com',
            'cpf' => $Client->cpf,
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'cpf' => ['O cpf informado ja foi cadastrado']
                ]
        ]);
    }

    public function test_invalid_required_email()
     {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => null,
            'cpf' => '111.111.111-13',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'email' => ['O campo email é obrigatório']
                ]
        ]);
    }

    public function test_invalid_type_email()
    {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 1111,
            'cpf' => '111.111.111-13',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'email' => ['O campo email deve ser uma string']
                ]
        ]);
    }

    public function test_invalid_max_email()
     {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 'felipe1roaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaad@gmail.com',
            'cpf' => '111.111.111-13',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'email' => ['O campo email deve ter no maximo 45 caracteres']
                ]
        ]);
    }



    public function test_invalid_unique_email()
    {
        $Client = Client::factory()->create();

        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => $Client->email,
            'cpf' => '111.111.111-13',
            'sex' => 'male'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'email' => ['O email informado ja foi cadastrado']
                ]
        ]);
    }

    public function test_invalid_required_sex()
    {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => "felipe1rod@gmail.com",
            'cpf' => '111.111.111-13',
            'sex' => null
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'sex' => ['O campo sexo é obrigatório']
                ]
        ]);
    }

    public function test_invalid_type_sex()
    {
        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => "felipe1rod@gmail.com",
            'cpf' => '111.111.111-13',
            'sex' => 'invalid'
        ];

         $response = $this->post('/api/clients',$clientData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'sex' => ['O sexo informado é invalido']
                ]
        ]);
    }

}
