<?php declare(strict_types=1);

namespace nsav4uk\CloudflareBundle\Command;

use nsav4uk\CloudflareBundle\Service\CloudflareClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListZonesCommand extends Command
{
    protected static $defaultName = 'cloudflare:list-zones';
    private $client;

    public function __construct(CloudflareClient $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Show list of zones')
            ->setHelp('This command show list of your zones')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $zones = $this->client->getZones();

        $io = new SymfonyStyle($input, $output);
        $zonePlans = [];

        foreach ($zones as $zone) {
            $zonePlans[] = [$zone->name, $zone->plan->name];
        }

        $io->table(
            ['Name', 'Plan'],
            $zonePlans
        );

        return 0;
    }
}
