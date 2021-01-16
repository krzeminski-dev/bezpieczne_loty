<?php

namespace App\Command;

use App\Service\CountryRoutesGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadRoutesCommand extends Command
{
    protected static $defaultName = 'app:load:routes';
    /**
     * @var CountryRoutesGenerator
     */
    private $generator;


    public function __construct(CountryRoutesGenerator $generator, string $name = null)
    {
        parent::__construct($name);
        $this->generator = $generator;
    }

    protected function configure()
    {
        $this
            ->setDescription('Generate random connections between countries')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->generator->generate();

        $io->success('Successfully saved country routes to database!');

        return Command::SUCCESS;
    }
}
