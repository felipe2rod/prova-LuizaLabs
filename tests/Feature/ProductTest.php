<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_get_all_products()
    {

        $response = $this->get('/api/produtos');

        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'price',
                        'color',
                        'size'
                    ]
                ]
            ]);
    }


    public function test_post_success()
    {
        $productData = [
            'name' => 'Nome do produto',
            'color' => 'red',
            'size' => 'p',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => 'Successfully created'
        ]);
    }

    public function test_post_invalid_required_name()
    {
        $productData = [
            'name' => null,
            'color' => 'red',
            'size' => 'p',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
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
        $productData = [
            'name' => 1,
            'color' => 'red',
            'size' => 'p',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
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
        $productData = [
            'name' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'color' => 'red',
            'size' => 'p',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
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

    public function test_post_invalid_required_size()
     {
        $productData = [
            'name' => 'Nome do produto',
            'color' => 'red',
            'size' => null,
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'size' => ['O campo tamanho é obrigatório']
                ]
        ]);
    }

    public function test_post_invalid_type_size()
    {
        $productData = [
            'name' => 'Nome do produto',
            'color' => 'red',
            'size' => 11111111111111,
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'size' => ['O campo tamanho deve ser uma string']
                ]
        ]);
    }

    public function test_post_invalid_max_size()
     {
        $productData = [
            'name' => 'Nome do produto',
            'color' => 'red',
            'size' => '11111111111111111111111111',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'size' => ['O campo tamanho deve ter 15 caracteres']
                ]
        ]);
    }


    public function test_post_invalid_required_color()
     {
        $productData = [
            'name' => 'Nome do produto',
            'color' => null,
            'size' => 'p',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'color' => ['O campo cor é obrigatório']
                ]
        ]);
    }

    public function test_post_invalid_type_color()
    {
        $productData = [
            'name' => 'Nome do produto',
            'color' => 1111,
            'size' => 'p',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'color' => ['O campo cor deve ser uma string']
                ]
        ]);
    }

    public function test_post_invalid_max_color()
     {
        $productData = [
            'name' => 'Nome do produto',
            'color' => 'felipe1roaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaad@gmail.com',
            'size' => 'p',
            'price' => 10.9,
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'color' => ['O campo cor deve ter 15 caracteres']
                ]
        ]);
    }




    public function test_post_invalid_required_price()
    {
        $productData = [
            'name' => 'Nome do produto',
            'color' => "red",
            'size' => 'p',
            'price' => null
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'price' => ['O campo preço é obrigatório']
                ]
        ]);
    }

    public function test_post_invalid_type_price()
    {
        $productData = [
            'name' => 'Nome do produto',
            'color' => "red",
            'size' => 'p',
            'price' => 'invalid'
        ];

         $response = $this->post('/api/produtos',$productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'price' => ['O campo preço deve ser um numero']
                ]
        ]);
    }

    public function test_show_client(){

        $Product = Product::factory()->create();

        $response = $this->get("/api/produtos/{$Product->id}");

        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => [
                        'id' => $Product->id,
                        'name' => $Product->name,
                        'size' => $Product->size,
                        'color' => $Product->color,
                        'price' => 'R$ '.number_format($Product->price, 2, ',', '.')
                    ]
            ]);
    }

    public function test_invalid_show_client(){
        $response = $this->get("/api/produtos/000");

        $response
            ->assertStatus(JsonResponse::HTTP_NOT_FOUND)
            ->assertJson([
                'success' => false,
                'message' => 'get error',
                'data' => [
                    'meta' => 'No query results for model [App\\Models\\Product] 000'
                ]
            ]);
    }


    public function test_put_success()
    {
        $Product = Product::factory()->create();

        $productData = [
            'name' => "Novo nome",
            'color' => 'yellow',
            'size' => 'g',
            'price' => 14.90
        ];

        $response = $this->put("/api/produtos/{$Product->id}", $productData);
        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => 'Successfully updated'
        ]);

        $productData['price'] = 'R$ '.number_format($productData['price'], 2, ',', '.');
        $response = $this->get("/api/produtos/{$Product->id}");
        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => array_merge(['id' => $Product->id],$productData)
        ]);
    }


    public function test_put_invalid_type_name()
    {
        $Product = Product::factory()->create();
        $productData = [
            'name' => null,
        ];

         $response = $this->put('/api/produtos/{$Product->id}', $productData);
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
        $Product = Product::factory()->create();
        $productData = [
            'name' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
        ];

         $response = $this->put('/api/produtos/{$Product->id}', $productData);
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

    public function test_put_invalid_type_size()
    {
        $Product = Product::factory()->create();

        $productData = [
            'size' => 11111111111111,
        ];

        $response = $this->put('/api/produtos/{$Product->id}', $productData);
        $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'size' => ['O campo tamanho deve ser uma string']
                ]
        ]);
    }

    public function test_put_invalid_max_size()
    {
        $Product = Product::factory()->create();

        $productData = [
            'size' => '1111111111111111111',
        ];

         $response = $this->put('/api/produtos/{$Product->id}', $productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'size' => ['O campo tamanho deve ter 15 caracteres']
                ]
        ]);
    }
 

    public function test_put_invalid_type_color()
    {
        $Product = Product::factory()->create();

        $productData = [
            'color' => 1111,
        ];

         $response = $this->put('/api/produtos/{$Product->id}', $productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'color' => ['O campo cor deve ser uma string']
                ]
        ]);
    }

    public function test_put_invalid_max_color()
     {
        $Product = Product::factory()->create();

        $productData = [
            'color' => 'felipe1roaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaad@gmail.com',
        ];

         $response = $this->put('/api/produtos/{$Product->id}', $productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'color' => ['O campo cor deve ter 15 caracteres']
                ]
        ]);
    }



    public function test_put_invalid_type_price()
    {
        $Product = Product::factory()->create();
        $productData = [
            'price' => 'invalid'
        ];

         $response = $this->put('/api/produtos/{$Product->id}', $productData);
         $response
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => 'Validation failed',
                'data' => [
                    'price' => ['O campo preço deve ser um numero']
                ]
        ]);
    }

    public function test_delete_sucess()
    {
        $Product = Product::factory()->create();

        $response = $this->delete("/api/produtos/{$Product->id}");
        $response
            ->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'data' => 'Successfully deleted'
        ]);
    }

    public function test_delete_error()
    {

        $response = $this->delete('/api/produtos/000');
        $response
            ->assertStatus(JsonResponse::HTTP_NOT_FOUND)
            ->assertJson([
                'success' => false,
                "message"=> "delete error",
                'data' => [
                    "meta"=> "No query results for model [App\\Models\\Product] 000"
                ]
        ]);
    }
}
