<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_belongs_to_user()
    {
        // creamos data falsa con factory
        $repository = Repository::factory()->create();

        // probar si la propiedad repositorios de los usuarios es una collecion
        $this->assertInstanceOf(
            User::class,
            $repository->user
        );
    }
}
