<?php

namespace Tests\Browser;

use App\Actions\Jetstream\CreateTeam;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testBasicExample()
    {
        $user = User::factory()->create();

        (new CreateTeam())->create($user, [
            'name' => 'Test Team',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('@login-email', $user->email)
                ->type('@login-password', 'password')
                ->press('@login-button')
                ->assertPathIs('/dashboard')
                ->assertSee('Dashboard');

            $browser->visitRoute('posts.create')
                ->screenshot('posts-form')
                ->press('@create-posts-button')
                ->waitForText('Something went wrong')
                ->assertPathIs('/posts/create');

            $browser->visit('/')
                ->assertSee('Dashboard')
                ->assertPathIs('/');
        });
    }
}
