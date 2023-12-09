<?php
use Tests\TestCase;
use Illuminate\Foundation\Application;
use App\Providers\AppServiceProvider;

class AppServiceProviderTest extends TestCase
{
    public function testServiceProviderIsRegistered()
    {
        // Criar uma instância simulada da aplicação Laravel
        $app = new Application();

        // Criar uma instância do provedor de serviços, passando a aplicação
        $provider = new AppServiceProvider($app);

        // Testar se o provedor de serviços é uma instância de ServiceProvider
        $this->assertInstanceOf(\Illuminate\Support\ServiceProvider::class, $provider);

        // Testar se o método register não tem efeito colateral
        $this->assertNull($provider->register());

        // Testar se o método boot não tem efeito colateral
        $this->assertNull($provider->boot());
    }
}
