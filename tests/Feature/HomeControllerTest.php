<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testHomePage()
    {
        $this->get(route('home'))->assertStatus(200)
            ->assertDontSee('Go to My Projects');

        $this->signIn();

        $this->get(route('home'))->assertStatus(200)
            ->assertSee('Go to My Projects');
    }
}
