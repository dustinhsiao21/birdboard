<?php

namespace Tests\Unit\Repositories;

use App\User;
use Tests\TestCase;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $repo;

    public function setUp() : void
    {
        parent::setUp();
        $this->repo = app(UserRepository::class);
    }

    public function testFindAllExcept()
    {
        factory(User::class, 10)->create();

        $except = [9, 10];
        $result = $this->repo->findAllExcept($except);

        $this->assertEquals(8, $result->count());
        $this->assertEquals(8, $result->last()->id);
    }
}
