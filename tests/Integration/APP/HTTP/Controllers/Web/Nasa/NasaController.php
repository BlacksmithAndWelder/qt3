<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class NasaControllerTest extends TestCase
{
    use RefreshDatabase;
    const NASA_API_URL = 'https://api.nasa.gov/planetary/apod?api_key=v1hq9QBJCJ0KMFnCL9soFRgPWfbluwHXhJyrkTC2';

    /** @test */
    public function it_can_fetch_nasa_details()
    {
        // Mock the response from the NASA API
        Http::fake([
            self::NASA_API_URL => Http::response(['mock' => 'data'], 200),
        ]);

        // Make a request to the detalhe endpoint
        $response = $this->get(route('nasa.detalhe'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('nasa.detalhe');

        // Assert that the NASA API was called with the correct parameters
        Http::assertSent(function ($request) {
            return $request->url() == self::NASA_API_URL &&
                $request->method() == 'GET';
        });
    }

    /** @test */
    public function it_handles_failure_to_fetch_nasa_details()
    {
        // Mock a failed response from the NASA API
        Http::fake([
            self::NASA_API_URL => Http::response([], 500),
        ]);

        // Make a request to the detalhe endpoint
        $response = $this->get(route('nasa.detalhe'));

        // Assert a successful response and that the view is being returned
        $response->assertSuccessful()->assertViewIs('nasa.detalhe');

        // Assert that the session contains an error message
        $this->assertEquals('danger', Session::get('classe'));
        $this->assertEquals('Não foi possível realizar requisição API -Nasa!', Session::get('mensagem'));
    }

    // Add more test methods for other actions in NasaController
}
