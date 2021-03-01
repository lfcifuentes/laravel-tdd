<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    public function test_has_many_repositories()
    {
        $user = new User;

        // probar si la propiedad repositorios de los usuarios es una collecion
        $this->assertInstanceOf(
            Collection::class,
            $user->repositories
        );
    }
}
