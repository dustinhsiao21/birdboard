<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
