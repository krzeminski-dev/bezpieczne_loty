<?php

namespace App\Command;

use App\Service\DataLoader;
use App\Service\DiseaseApiProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadCountriesCommand extends Command
{
    protected static $defaultName = 'app:load:countries';
    /**
     * @var DiseaseApiProvider
     */
    private $provider;
    /**
     * @var DataLoader
     */
    private $loader;

    public function __construct(DataLoader $loader, DiseaseApiProvider $provider, string $name = null)
    {
        parent::__construct($name);
        $this->provider = $provider;
        $this->loader = $loader;
    }

    protected function configure()
    {
        $this
            ->setDescription('Load countries from disease.sh API')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->loader->load($this->provider->getCountries());

        $io->success('Successfully saved countries to database!');

        return Command::SUCCESS;
    }
}
