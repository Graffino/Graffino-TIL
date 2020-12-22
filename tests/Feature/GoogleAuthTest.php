<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\Factory as Socialite;
use PHPUnit\Framework\TestCase;
use Mockery;
use Socialite;


class GoogleAuthTest extends TestCase
{
/**
     * A basic test example.
     *
     * @return void
     */
    public function testGoogleLogin()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');         
        $abstractUser->shouldReceive('getId') 
        ->andReturn(1234567890)
        ->shouldReceive('getEmail')
        ->andReturn(str_random(10).'@graffino.com')
        ->shouldReceive('getNickname')
        ->andReturn('Pseudo')
        ->shouldReceive('getName')
        ->andReturn('Arlette Laguiller')
        ->shouldReceive('getAvatar')
        ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');

        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $this->visit(route("https://til2.graffino.dev/auth/google/callback"))
        ->seePageIs(route("https://til2.graffino.dev/posts/new"));
    }
}
