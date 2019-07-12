<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testSettingPage()
    {
        $user = $this->signIn();
        $this->get(route('user.setting'))
            ->assertStatus(200)
            ->assertSee($user->name);
    }

    public function testStoreData()
    {
        $this->signIn();
        $data = [
            'name' =>  $name = $this->faker->name,
        ];

        $this->post(route('user.setting.update', $data))->assertRedirect(route('project.index'));

        $this->assertDatabaseHas('users', $data);
    }
}
