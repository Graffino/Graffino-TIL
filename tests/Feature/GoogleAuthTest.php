<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Socialite;
use Mockery;
use Tests\TestCase;
class GoogleAuthTest extends TestCase
{
    use RefreshDatabase;
/**
     * A basic test example.
     *
     * @return void
     */
    public function testGoogleLogin()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');         
        
        $abstractUser->email = 'test@graffino.com';
        $abstractUser->name = 'test';

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');

        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $this->get(route('auth.callback', ['provider' => 'google']))
        ->assertStatus(302)
        ->assertRedirect(route('posts'));

        $this->get(route('posts.new'))
        ->assertStatus(200);
    }
}
