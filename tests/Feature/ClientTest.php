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
    
    public function test_get_all_clients()
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

    public function test_post__success()
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

    public function test_post_invalid_required_name()
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

    public function test_post_invalid_type_name()
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

    public function test_post_invalid_max_size_name()
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

    public function test_post_invalid_required_cpf()
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

    public function test_post_invalid_type_cpf()
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

    public function test_post_invalid_max_cpf()
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

    public function test_post_invalid_min_cpf()
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


    public function test_post_invalid_unique_cpf()
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

    public function test_post_invalid_required_email()
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

    public function test_post_invalid_type_email()
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

    public function test_post_invalid_max_email()
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



    public function test_post_invalid_unique_email()
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

    public function test_post_invalid_required_sex()
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

    public function test_post_invalid_type_sex()
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

    public function test_show_client(){

        $Client = Client::factory()->create();

        $response = $this->get("/api/clients/{$Client->id}");

        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => [
                        'id' => $Client->id,
                        'name' => $Client->name,
                        'cpf' => $Client->cpf,
                        'email' => $Client->email,
                        'sex' => $Client->sex == 'male' ? 'Masculino': 'Feminino'
                    ]
            ]);
    }

    public function test_invalid_show_client(){
        $response = $this->get("/api/clients/000");

        $response
            ->assertStatus(JsonResponse::HTTP_NOT_FOUND)
            ->assertJson([
                'success' => false,
                'message' => 'get error',
                'data' => [
                    'meta' => 'No query results for model [App\\Models\\Client] 000'
                ]
            ]);
    }


    public function test_put_success()
    {
        $Client = Client::factory()->create();

        $clientData = [
            'name' => "Novo nome",
            'email' => 'novoemail@gmail.com',
            'cpf' => '111.311.111-13',
            'sex' => 'female'
        ];

        $response = $this->put("/api/clients/{$Client->id}", $clientData);
        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => 'Successfully updated'
        ]);

        $clientData['sex'] = $clientData['sex'] ==  'male' ? 'Masculino': 'Feminino';
        $response = $this->get("/api/clients/{$Client->id}");
        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => array_merge(['id' => $Client->id],$clientData)
        ]);
    }


    public function test_put_invalid_type_name()
    {
        $Client = Client::factory()->create();
        $clientData = [
            'name' => null,
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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

    public function test_put_invalid_max_size_name()
    {
        $Client = Client::factory()->create();
        $clientData = [
            'name' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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

    public function test_put_invalid_type_cpf()
    {
        $Client = Client::factory()->create();

        $clientData = [
            'cpf' => 11111111111111,
        ];

        $response = $this->put('/api/clients/{$Client->id}', $clientData);
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

    public function test_put_invalid_max_cpf()
    {
        $Client = Client::factory()->create();

        $clientData = [
            'cpf' => '111111111111111',
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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

    public function test_put_invalid_min_cpf()
    {
        $Client = Client::factory()->create();

        $clientData = [
            'cpf' => '1',
        ];

        $response = $this->put('/api/clients/{$Client->id}', $clientData);
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


    public function test_put_invalid_unique_cpf()
    {
        $Client = Client::factory()->create();
        $Client2 = Client::factory()->create();

        $clientData = [
            'name' => 'Felipe Rodrigues',
            'email' => 'felipe1rod@gmail.com',
            'cpf' => $Client2->cpf,
            'sex' => 'male'
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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

    public function test_put_invalid_type_email()
    {
        $Client = Client::factory()->create();

        $clientData = [
            'email' => 1111,
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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

    public function test_put_invalid_max_email()
     {
        $Client = Client::factory()->create();

        $clientData = [
            'email' => 'felipe1roaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaad@gmail.com',
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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



    public function test_put_invalid_unique_email()
    {
        $Client = Client::factory()->create();
        $Client2 = Client::factory()->create();

        $clientData = [
            'email' => $Client2->email,
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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

    public function test_put_invalid_type_sex()
    {
        $Client = Client::factory()->create();
        $clientData = [
            'sex' => 'invalid'
        ];

         $response = $this->put('/api/clients/{$Client->id}', $clientData);
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
