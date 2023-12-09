<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class PreventRequestsDuringMaintenanceMiddlewareTest extends TestCase
{
    /** @test */
    public function it_allows_access_to_uris_defined_in_except_array_during_maintenance_mode()
    {
        // Enable maintenance mode
        $this->enableMaintenanceMode();

        // Try to access a URI that is in the except array
        $response = $this->get('/allowed-uri');

        // Assert that the response is successful (indicating access is allowed)
        $response->assertSuccessful();
    }

    /** @test */
    public function it_prevents_access_to_uris_not_defined_in_except_array_during_maintenance_mode()
    {
        // Enable maintenance mode
        $this->enableMaintenanceMode();

        // Try to access a URI that is NOT in the except array
        $response = $this->get('/disallowed-uri');

        // Assert that the response is a maintenance mode response (indicating access is prevented)
        $response->assertStatus(503);
    }

    /** @test */
    public function it_allows_access_to_uris_outside_maintenance_mode()
    {
        // Disable maintenance mode
        $this->disableMaintenanceMode();

        // Try to access a URI (whether in except array or not)
        $response = $this->get('/any-uri');

        // Assert that the response is successful (indicating access is allowed)
        $response->assertSuccessful();
    }

    // Helper methods for enabling/disabling maintenance mode
    private function enableMaintenanceMode()
    {
        touch(storage_path('framework/down'));
    }

    private function disableMaintenanceMode()
    {
        @unlink(storage_path('framework/down'));
    }
}
