<?php declare(strict_types=1);

namespace nsav4uk\CloudflareBundle\Command;

use nsav4uk\CloudflareBundle\Service\CloudflareClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserInfoCommand extends Command
{
    protected static $defaultName = 'cloudflare:user-info';
    private $client;

    public function __construct(CloudflareClient $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Show cloudflare user info')
            ->setHelp('This command show user info')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $user = $this->client->get('user');
        if ($user->getBody()) {
            $body = json_decode((string)$user->getBody());

            $userData = [];

            foreach ($body->result as $key => $value) {
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }
                $userData[] = [$key, $value];
            }

            $io->table(
                ['Field', 'Value'],
                $userData
            );
        }

        return 0;
    }
}
