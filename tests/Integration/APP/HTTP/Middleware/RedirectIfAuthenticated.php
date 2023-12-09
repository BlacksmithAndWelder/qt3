<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticatedMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_authenticated_users_away_from_protected_routes()
    {
        // Create a user and authenticate them
        $user = factory(\App\Models\User::class)->create();
        Auth::login($user);

        // Try to access a protected route
        $response = $this->get(route('protected.route'));

        // Assert that the user is redirected to the home route
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function it_allows_non_authenticated_users_to_access_protected_routes()
    {
        // Ensure the user is not authenticated
        Auth::logout();

        // Try to access a protected route
        $response = $this->get(route('protected.route'));

        // Assert that the user is not redirected
        $response->assertSuccessful();
    }

    // Add more test methods if there are additional cases to cover
}
