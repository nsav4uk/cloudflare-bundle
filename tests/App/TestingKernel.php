<?php declare(strict_types=1);

namespace nsav4uk\CloudflareBundle\Tests\App;

use nsav4uk\CloudflareBundle\CloudflareBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestingKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', false);
    }

    public function registerBundles()
    {
        return [
            new CloudflareBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // TODO: Implement registerContainerConfiguration() method.
    }
}
