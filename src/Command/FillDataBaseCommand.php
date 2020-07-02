<?php

namespace App\Command;

use App\Services\FillDataBaseService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FillDataBaseCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:fill-data-base';

    /**
     * @var FillDataBaseService
     */
    private $fillDataBase;

    public function __construct(string $name = null, FillDataBaseService $fillDataBase)
    {
        parent::__construct($name);
        $this->fillDataBase = $fillDataBase;
    }

    protected function configure()
    {
        $this->setDescription('Initialize Data Base');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->fillDataBase->fillData();
        } catch (\Exception $exception) {
            $io->error(['error' => $exception->getMessage()]);
        }

        $io->success('Data Created!');

        return 0;
    }
}
