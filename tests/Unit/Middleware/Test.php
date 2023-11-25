<?php
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Routing\UrlGenerator;

class AuthenticateMiddlewareTest extends \PHPUnit\Framework\TestCase
{
    public function testRedirectsToLoginWhenNotAuthenticated()
    {
        // Create a mock for the UrlGenerator interface
        $urlGeneratorMock = $this->createMock(UrlGenerator::class);
        // Define the expected route('login') call and its return value
        $urlGeneratorMock->expects($this->once())
            ->method('route')
            ->with('login')
            ->willReturn('/login');

        // Bind the mocked UrlGenerator to the IoC container so it's used by the middleware
        app()->instance(UrlGenerator::class, $urlGeneratorMock);

        // Create a request that does not expect JSON
        $request = Request::create('/some-url');

        // Create an instance of the Authenticate middleware
        $middleware = new Authenticate();

        // Call the redirectTo method with the request
        $redirectPath = $middleware->redirectTo($request);

        // Assert that the redirect path is the expected login route
        $this->assertEquals('/login', $redirectPath);
    }

    // You can add more test cases as needed
}
