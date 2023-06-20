<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PlaceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testStore()
    {
        // Dados de teste para criar um novo lugar
        $data = [
            'name' => 'Nome do lugar',
            'slug' => 'nome-do-lugar',
            'city' => 'Cidade',
            'state' => 'Estado'
        ];

        // Faça a requisição POST para a rota de criação de lugares
        $response = $this->post('api/places', $data);

        // Verifique se a resposta tem o status HTTP 201 Created
        $response->assertStatus(201);

        // Verifique se a resposta contém os dados do lugar criado
        $response->assertJson($data);

        // Verifique se o lugar foi salvo no banco de dados
        $this->assertDatabaseHas('places', $data);
    }

    
    public function testIndex()
    {
        // Crie alguns lugares de teste
        $faker = Faker::create();
        $counter = 0;
        $places = Place::factory()
            ->count(3)
            ->create([
                'name' => 'Novo nome do lugar',
                'slug' => function () use ($faker, &$counter) {
                    $slug = Str::slug($faker->unique()->sentence(3), '-');
                    $slug .= '-' . ++$counter;
                    return $slug;
                },
                'city' => 'Nova Cidade',
                'state' => 'Novo Estado'
            ]);

        // Faça a requisição GET para a rota de listagem de lugares
        $response = $this->get('api/places');

        // Verifique se a resposta tem o status HTTP 200 OK
        $response->assertStatus(200);

        // Verifique se a resposta contém os lugares criados
        $response->assertJson($places->toArray());
    }

    public function testShow()
    {
        // Crie um lugar de teste
        $place = Place::factory()->create([
            'name' => 'Nome do lugar',
            'slug' => 'slug-do-lugar',
            'city' => 'Cidade',
            'state' => 'Estado'
        ]);

        // Faça a requisição GET para a rota de exibição do lugar
        $response = $this->get('api/places/' . $place->id);

        // Verifique se a resposta tem o status HTTP 200 OK
        $response->assertStatus(200);

        // Verifique se a resposta contém os detalhes do lugar criado
        $response->assertJson($place->toArray());
    }

    public function testUpdate()
    {
        // Crie um lugar de teste
        $place = Place::factory()->create([
            'name' => 'Nome do lugar',
            'slug' => 'slug-do-lugar',
            'city' => 'Cidade',
            'state' => 'Estado'
        ]);

        // Faça a requisição PUT para a rota de atualização do lugar
        $response = $this->put('api/places/' . $place->id, [
            'name' => 'Novo nome do lugar',
            'city' => 'Nova cidade',
            'state' => 'Novo estado'
        ]);

        // Verifique se a resposta tem o status HTTP 200 OK
        $response->assertStatus(200);

        // Verifique se a resposta contém os detalhes atualizados do lugar
        $response->assertJson([
            'name' => 'Novo nome do lugar',
            'slug' => 'slug-do-lugar',
            'city' => 'Nova cidade',
            'state' => 'Novo estado'
        ]);
    }


    public function testDestroy()
    {
        // Crie um lugar de teste
        $place = Place::factory()->create([
            'name' => 'Nome do lugar',
            'slug' => 'slug-do-lugar',
            'city' => 'Cidade',
            'state' => 'Estado'
        ]);

        // Faça a requisição DELETE para a rota de exclusão do lugar
        $response = $this->delete('api/places/' . $place->id);

        // Verifique se a resposta tem o status HTTP 204 No Content
        $response->assertStatus(204);

        // Verifique se o lugar foi excluído do banco de dados
        $this->assertDatabaseMissing('places', [
            'id' => $place->id,
            'name' => 'Nome do lugar'
        ]);
    }

    
}
