<?php

namespace App\Command;

use App\Service\TransportCsvParser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'transport:parse',
    description: 'Парсит CSV-файл транспорта и выводит результат',
)]
class ParseTransportCommand extends Command
{
    public function __construct(
        private TransportCsvParser $parser
    ) {
        parent::__construct('transport:parse');
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'Путь к CSV-файлу');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('file');
        $transports = $this->parser->parse($filePath);

        foreach ($transports as $transport) {
            dump($transport);
        }

        return Command::SUCCESS;
    }
}