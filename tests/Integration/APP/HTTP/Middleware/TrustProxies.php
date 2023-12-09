<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrustProxiesMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sets_trusted_proxies_and_headers()
    {
        // Set the trusted proxies and headers in your middleware configuration
        $this->app['config']->set('trustedproxy.proxies', ['192.168.1.1']);
        $this->app['config']->set('trustedproxy.headers', [
            \Illuminate\Http\Request::HEADER_FORWARDED => null,
            \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
            \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
        ]);

        // Make a request to a test route
        $response = $this->get(route('test.route'));

        // Assert that the response is successful
        $response->assertSuccessful();

        // Add assertions based on the expected behavior of the middleware
        // For example, check if the X_FORWARDED_FOR header is set with the correct value
        $this->assertEquals('192.168.1.1', $response->headers->get('X_FORWARDED_FOR'));
    }

    // Add more test methods if there are additional cases to cover
}
