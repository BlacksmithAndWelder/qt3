<?php
namespace Tests\Unit\Http\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class RedirectIfAuthenticatedTest extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Test if the middleware redirects authenticated users.
     *
     * @return void
     */
    public function testRedirectsAuthenticatedUsers()
    {
        // Set up a fake authenticated user
        $user = factory(User::class)->create();
        Auth::login($user);

        // Create a fake request
        $request = Request::create('/fake-route');

        // Create an instance of the middleware
        $middleware = new RedirectIfAuthenticated;

        // Call the handle method
        $response = $middleware->handle($request, function () {
            return response('Next middleware was called.');
        });

        // Assert that the response is a redirect to the home route
        $this->assertRedirectedToRoute('home');

        // You can also assert other things, depending on your requirements
        // For example, you might want to assert that the response is an instance of RedirectResponse
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
    }
}
