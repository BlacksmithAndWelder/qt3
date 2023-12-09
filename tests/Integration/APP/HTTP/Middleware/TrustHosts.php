<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrustHostsMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_trusts_specified_host_patterns()
    {
        // Define the expected host patterns
        $trustedHosts = [
            'localhost',
            'subdomain.example.com',
            // Add other trusted host patterns, if needed
        ];

        // Make a request to a test route
        $response = $this->get(route('test.route'));

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the trusted host patterns are present in the headers
        foreach ($trustedHosts as $trustedHost) {
            $this->assertContains($trustedHost, $response->headers->get('host'));
        }
    }

    // Add more test methods if there are additional cases to cover
}
