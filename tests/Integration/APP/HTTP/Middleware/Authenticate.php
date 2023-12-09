<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthenticateMiddlewareTest extends TestCase
{
    const PROTECTED_ROUTE = '/protected';
    const PROTECTED_CONTENT = 'Protected Route';

    /** @test */
    public function it_redirects_guest_users_to_the_login_page()
    {
        // Define a route that uses the Authenticate middleware
        Route::get(self::PROTECTED_ROUTE, function () {
            return self::PROTECTED_CONTENT;
        })->middleware('auth');

        // Make a request to the protected route without authentication
        $response = $this->get(self::PROTECTED_ROUTE);

        // Assert that the response is a redirect to the login route
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function it_allows_authenticated_users_to_access_protected_routes()
    {
        // Define a route that uses the Authenticate middleware
        Route::get(self::PROTECTED_ROUTE, function () {
            return self::PROTECTED_CONTENT;
        })->middleware('auth');

        // Mock authentication
        $user = factory(\App\Models\User::class)->create();
        $this->actingAs($user);

        // Make a request to the protected route with authentication
        $response = $this->get(self::PROTECTED_ROUTE);

        // Assert that the response is successful and contains the expected content
        $response->assertSuccessful()->assertSee(self::PROTECTED_CONTENT);
    }
}
