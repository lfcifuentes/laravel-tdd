<?php

namespace Tests\Feature\Http\Controllers;

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
	 *
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
}
