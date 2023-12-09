<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class EncryptCookiesMiddlewareTest extends TestCase
{
    /** @test */
    public function it_encrypts_cookies_defined_in_except_array()
    {
        // Set up your application's route that utilizes cookies
        // For example, a route that sets a cookie named 'example_cookie'
        $response = $this->get('/set-cookie');

        // Retrieve the 'example_cookie' from the response headers
        $encryptedCookie = $response->headers->getCookies()[0];

        // Assert that the cookie is encrypted
        $this->assertTrue($encryptedCookie->isEncrypted());
    }

    /** @test */
    public function it_does_not_encrypt_cookies_not_defined_in_except_array()
    {
        // Set up your application's route that utilizes cookies
        // For example, a route that sets a cookie named 'unencrypted_cookie'
        $response = $this->get('/set-unencrypted-cookie');

        // Retrieve the 'unencrypted_cookie' from the response headers
        $unencryptedCookie = $response->headers->getCookies()[0];

        // Assert that the cookie is not encrypted
        $this->assertFalse($unencryptedCookie->isEncrypted());
    }
}
