<?php
<?php

namespace Tests\Unit\Http\Requests\Escola;

use App\Http\Requests\Escola\Request;
use Tests\TestCase;

class EscolaRequestTest extends TestCase
{
    /**
     * Test if the user is authorized to make the request.
     *
     * @return void
     */
    public function testAuthorize()
    {
        $request = new Request();

        // Assuming your authorization logic is based on a user.
        // You can mock a user or set up your user authentication logic accordingly.
        // For example, if the user is authenticated, the authorization should return true.

        // Mocking an authenticated user
        $this->actingAs(factory(\App\User::class)->create());

        // Call the authorize method and assert that it returns true
        $this->assertTrue($request->authorize());
    }
}
