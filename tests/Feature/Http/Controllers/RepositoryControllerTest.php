<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositoryControllerTest extends TestCase
{
	use WithFaker, RefreshDatabase;
	/**
	 * Test for access to Repositories routes.
	 *
	 * @return void
	 */
	public function test_guest()
	{
		// Validar los accesos a las rutas
		$this->get('repositories')->assertRedirect('login');        // index
		$this->get('repositories/1')->assertRedirect('login');      // show
		$this->get('repositories/1/edit')->assertRedirect('login'); // edit
		$this->put('repositories/1')->assertRedirect('login');      // update
		$this->delete('repositories/1')->assertRedirect('login');   // delete
		$this->get('repositories/create')->assertRedirect('login'); // create
		$this->post('repositories', [])->assertRedirect('login');   // store
	}

	/**
	 * Test for create repository
	 * @return void
	 */
	public function test_store()
	{
		$this->withoutExceptionHandling();

		// datos fake para llenar el repositorio
		$data = [
			'url' => $this->faker->url,
			'description' => $this->faker->text,
		];

		// usuario
		$user = User::factory()->create();

		// validar
		$this
			->actingAs($user)						// setear usuario que hace la acción
			->post('repositories', $data)		// hacer el post
			->assertRedirect('repositories');	// validar la redirección al index

		// validar que si se insertaron los datos
		$this->assertDatabaseHas('repositories', $data);

	}
	/**
	 * test to verify repository save validations
	 * @return void
	 */
	public function test_validate_store()
	{
		// usuario
		$user = User::factory()->create();

		// validar
		$this
			->actingAs($user)				// setear usuario que hace la acción
			->post('repositories', [])		// hacer el post
			->assertStatus(302)				// validar la redirección al index
			->assertSessionHasErrors([
				'url','description'
			]);

	}
	/**
	 * Test for update repository
	 */
	public function test_update()
	{
		$this->withoutExceptionHandling();

		// crear usuario fake que envia los datos
		$user = User::factory()->create();
		// crear repositorio fake
		$repository = Repository::factory()->create(['user_id' => $user->id]);
		// datos fake para llenar el repositorio
		$data = [
			'url' => $this->faker->url,
			'description' => $this->faker->text,
		];
		// enviar datos
		$this
			->actingAs($user)
			->put("repositories/{$repository->id}", $data)
			->assertRedirect("repositories/{$repository->id}/edit");

		// validar que si se actualizaron los datos
		$this->assertDatabaseHas('repositories', $data);
	}
	/**
	 * Test for update repository
	 */
	public function test_validate_update()
	{
		// crear usuario fake que envia los datos
		$user = User::factory()->create();
		// crear repositorio fake
		$repository = Repository::factory()->create(['user_id' => $user->id]);
		
		// enviar datos
		$this
			->actingAs($user)
			->put("repositories/{$repository->id}", [])
			->assertStatus(302)				// validar la redirección al index
			->assertSessionHasErrors([
				'url','description'
			]);
	}
	/**
	 * Test to update only my repositories
	 */
	public function test_update_policy()
	{
		// crear usuario fake que envia los datos
		$user = User::factory()->create();
		// crear repositorio fake
		$repository = Repository::factory()->create();
		// datos fake para llenar el repositorio
		$data = [
			'url' => $this->faker->url,
			'description' => $this->faker->text,
		];
		// enviar datos
		$this
			->actingAs($user)
			->put("repositories/{$repository->id}", $data)
			->assertStatus(403);
	}
	/**
	 * Test for delete repository
	 */
	public function test_delete()
	{
		$this->withoutExceptionHandling();

		// crear usuario fake que envia los datos
		$user = User::factory()->create();
		// crear repositorio fake
		$repository = Repository::factory()->create(['user_id' => $user->id]);
		
		// enviar acción de borrado
		$this
			->actingAs($user)
			->delete("repositories/{$repository->id}")
			->assertRedirect("repositories");

		// validar que si se booro el registro
		$this->assertDatabaseMissing('repositories', [
			'id' => $repository->id,
			'url' => $repository->url,
			'description' => $repository->description,
		]);
	}
	/**
	 * Test to delete only my repositories
	 */
	public function test_delete_policy()
	{
		// crear usuario fake que envia los datos
		$user = User::factory()->create();
		// crear repositorio fake
		$repository = Repository::factory()->create();
		
		// enviar acción de borrado
		$this
			->actingAs($user)
			->delete("repositories/{$repository->id}")
			->assertStatus(403);
	}
}
