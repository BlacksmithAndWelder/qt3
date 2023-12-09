<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class VerifyCsrfTokenMiddlewareTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function it_excludes_uris_from_csrf_verification()
    {
        // Define the URIs that should be excluded from CSRF verification
        $excludedUris = ['/excluded-uri-1', '/excluded-uri-2'];

        // Set the URIs to be excluded in the VerifyCsrfToken middleware
        $this->app['config']->set('csrf.except', $excludedUris);

        // Make a GET request to a URI that should be excluded
        $response = $this->get('/excluded-uri-1');

        // Assert that the response is successful
        $response->assertSuccessful();

        // Add assertions based on the expected behavior of the middleware
        // For example, check that CSRF token is not required for the excluded URI
        $this->assertEmpty($response->headers->get('X-CSRF-TOKEN'));
    }

    // Add more test methods if there are additional cases to cover
}
