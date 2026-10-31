<?php

namespace Tests\Feature;

use App\Models\Areas;
use App\Models\Apprentices;
use App\Models\Computers;
use App\Models\Courses;
use App\Models\Teachers;
use App\Models\TrainingCenters;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use DatabaseTransactions;

    public function test_resource_lists_and_details_return_json(): void
    {
        $area = Areas::create(['name' => 'Área API']);

        $this->getJson('/api/areas')
            ->assertOk()
            ->assertJsonMissingPath('data')
            ->assertJsonFragment(['name' => 'Área API']);

        $this->getJson('/api/areas/' . $area->id)
            ->assertOk()
            ->assertJsonPath('name', 'Área API');
    }

    public function test_resource_writes_require_an_administrator_token(): void
    {
        $this->postJson('/api/areas', ['name' => 'Área no autorizada'])
            ->assertUnauthorized();

        $user = User::factory()->create(['role' => 'apprentice']);

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/areas', ['name' => 'Área no autorizada'])
            ->assertForbidden()
            ->assertJsonPath('message', 'Esta operación requiere el rol administrador.');
    }

    public function test_administrator_can_login_and_manage_a_resource_with_a_token(): void
    {
        $user = User::factory()->create([
            'email' => 'api-admin@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $login = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertOk()
            ->assertJsonPath('token_type', 'Bearer')
            ->assertJsonPath('data.role', 'admin');

        $token = $login->json('token');

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('role', 'admin')
            ->assertJsonMissingPath('data');

        $created = $this->withToken($token)
            ->postJson('/api/areas', ['name' => 'Área desde API'])
            ->assertCreated()
            ->assertJsonPath('name', 'Área desde API');

        $areaId = $created->json('id');

        $this->withToken($token)
            ->patchJson('/api/areas/' . $areaId, ['name' => 'Área actualizada'])
            ->assertOk()
            ->assertJsonPath('name', 'Área actualizada');

        $this->withToken($token)
            ->deleteJson('/api/areas/' . $areaId)
            ->assertOk()
            ->assertJsonPath('message', 'Registro eliminado correctamente.');

        $this->withToken($token)
            ->postJson('/api/logout')
            ->assertOk();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'token' => hash('sha256', explode('|', $token, 2)[1]),
        ]);
    }

    public function test_resource_validation_errors_are_returned_as_json(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/areas', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function test_apprentice_can_be_created_updated_and_deleted_through_the_api(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $token = $user->createToken('test')->plainTextToken;

        $created = $this->withToken($token)
            ->postJson('/api/apprentices', [
                'name' => 'Aprendiz CRUD',
                'email' => 'aprendiz-crud@example.test',
                'cell_number' => '+573001234567',
            ])
            ->assertCreated()
            ->assertJsonPath('name', 'Aprendiz CRUD')
            ->assertJsonPath('computer', null)
            ->assertJsonPath('course', null);

        $apprenticeId = $created->json('id');

        $this->withToken($token)
            ->patchJson('/api/apprentices/' . $apprenticeId, ['name' => 'Aprendiz actualizado'])
            ->assertOk()
            ->assertJsonPath('name', 'Aprendiz actualizado');

        $this->withToken($token)
            ->deleteJson('/api/apprentices/' . $apprenticeId)
            ->assertOk()
            ->assertJsonPath('message', 'Aprendiz eliminado correctamente.');
    }

    public function test_all_data_resources_return_json_with_their_relationships(): void
    {
        $area = Areas::create(['name' => 'Área relación']);
        $center = TrainingCenters::create(['name' => 'Centro API', 'location' => 'Bogotá']);
        $computer = Computers::create(['number' => 501, 'brand' => 'Lenovo']);
        $teacher = Teachers::create([
            'name' => 'Instructor API',
            'email' => 'instructor-api@example.test',
            'area_id' => $area->id,
            'training_centers_id' => $center->id,
        ]);
        $course = Courses::create([
            'numero_de_curso' => 123,
            'day' => 'Lunes',
            'area_id' => $area->id,
            'training_centers_id' => $center->id,
        ]);
        $course->Teachers()->attach($teacher->id);
        Apprentices::create([
            'name' => 'Aprendiz API',
            'email' => 'aprendiz-api@example.test',
            'cell_number' => '3001234567',
            'course_id' => $course->id,
            'computer_id' => $computer->id,
        ]);

        foreach ([
            '/api/areas',
            '/api/training-centers',
            '/api/computers',
            '/api/teachers',
            '/api/courses',
            '/api/apprentices',
        ] as $url) {
            $this->getJson($url)->assertOk();
        }

        $this->getJson('/api/courses/' . $course->id)
            ->assertOk()
            ->assertJsonPath('apprentices.0.name', 'Aprendiz API')
            ->assertJsonPath('teachers.0.name', 'Instructor API');

        $this->getJson('/api/computers/' . $computer->id)
            ->assertOk()
            ->assertJsonPath('apprentices.0.name', 'Aprendiz API');
    }
}
