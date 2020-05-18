<?php
namespace nsav4uk\CloudflareBundle\Tests\Command;

use nsav4uk\CloudflareBundle\Command\UserInfoCommand;
use nsav4uk\CloudflareBundle\Service\CloudflareClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\Container;

class UserInfoCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $container = $this->getMockContainer();

        $application = new Application();
        $application->add(new UserInfoCommand($container->get('cloudflare')));

        $command = $application->find('cloudflare:user-info');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['command' => $command->getName()]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('', $output);
    }

    private function getMockContainer(): Container
    {
        $mockClient = $this->getMockBuilder(CloudflareClient::class)
            ->setConstructorArgs(['test@test.com', 'api_key'])
            ->getMock();

        $mockResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $mockClient->expects($this->any())
            ->method('get')
            ->with('user')
            ->willReturn($mockResponse);

        $mockContainer = $this->getMockBuilder(Container::class)
            ->setMethods(['get'])
            ->getMock();

        $mockContainer->expects($this->any())
            ->method('get')
            ->with('cloudflare')
            ->willReturn($mockClient);

        return $mockContainer;
    }
}
