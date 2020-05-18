<?php declare(strict_types=1);

namespace nsav4uk\CloudflareBundle\Service;

use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Endpoints\Zones;
use Cloudflare\API\Endpoints\User;
use Psr\Http\Message\ResponseInterface;

class CloudflareClient
{
    private $adapter;

    public function __construct(string $email, string $apiKey)
    {
        $key = new APIKey($email, $apiKey);
        $this->adapter = new Guzzle($key);
    }

    public function get(string $endpoint): ResponseInterface
    {
        return $this->adapter->get($endpoint);
    }

    public function getUser(): User
    {
        return new User($this->adapter);
    }

    public function getZones(): Zones
    {
        return new Zones($this->adapter);
    }
}
