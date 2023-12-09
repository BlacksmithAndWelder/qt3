<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrimStringsMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_trims_specified_attributes()
    {
        // Define test data with leading and trailing spaces
        $data = [
            'current_password' => '  current_password  ',
            'password' => '  password  ',
            'password_confirmation' => '  password_confirmation  ',
            // Add other attributes to test, if needed
        ];

        // Make a request with the test data
        $response = $this->post(route('test.route'), $data);

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the specified attributes are trimmed
        $this->assertEquals('current_password', $data['current_password']);
        $this->assertEquals('password', $data['password']);
        $this->assertEquals('password_confirmation', $data['password_confirmation']);
        // Add assertions for other attributes, if needed
    }

    // Add more test methods if there are additional cases to cover
}
