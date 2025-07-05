<?php

namespace App\Tests\Command;

use App\Command\ParseTransportCommand;
use App\DTO\TransportDto;
use App\Service\TransportBuilder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ParseTransportCommandTest extends KernelTestCase
{
    public function testParseCommandOutputsCorrectData(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $application = new \Symfony\Component\Console\Application();
        $application->add($container->get(ParseTransportCommand::class));

        $command = $application->find('transport:parse');
        $commandTester = new CommandTester($command);

        $testCsvPath = __DIR__.'/../Fixtures/transport.csv';
        $commandTester->execute([
            'file' => basename($testCsvPath),
        ]);

        $output = $commandTester->getDisplay();

        $this->assertStringContainsString('Nissan xTrail', $output);
        $this->assertStringContainsString('Man', $output);
        $this->assertStringContainsString('Mazda 6', $output);
        $this->assertStringContainsString('Hitachi', $output);
    }

    public function testParseEmptyCsv(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $application = new \Symfony\Component\Console\Application();
        $application->add($container->get(ParseTransportCommand::class));

        $command = $application->find('transport:parse');
        $commandTester = new CommandTester($command);

        $emptyCsvPath = __DIR__.'/../Fixtures/empty.csv';
        file_put_contents(
            $emptyCsvPath,
            "Тип,Марка,Фото,Количество пассажирских мест,Размеры кузова ДхШхВ,Грузоподъемность,Дополнительно\n"
        );

        $commandTester->execute(['file' => basename($emptyCsvPath)]);
        $output = $commandTester->getDisplay();

        $this->assertEmpty(trim($output), 'Ожидается пустой вывод для пустого CSV');

        unlink($emptyCsvPath);
    }

    public function testParseCsvWithInvalidType(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $application = new \Symfony\Component\Console\Application();
        $application->add($container->get(ParseTransportCommand::class));

        $command = $application->find('transport:parse');
        $commandTester = new CommandTester($command);

        $badCsvPath = __DIR__.'/../Fixtures/invalid.csv';
        file_put_contents(
            $badCsvPath,
            <<<CSV
                    Тип,Марка,Фото,Количество пассажирских мест,Размеры кузова ДхШхВ,Грузоподъемность,Дополнительно
                    unknown,SomeBrand,some.png,4,1x1x1,2.5,Test
                    CSV
        );

        $commandTester->execute(['file' => basename($badCsvPath)]);
        $output = $commandTester->getDisplay();

        $this->assertStringNotContainsString('SomeBrand', $output);
        $this->assertSame(0, substr_count($output, 'SomeBrand'), 'Некорректный тип не должен выводиться');

        unlink($badCsvPath);
    }

    public function testTransportParserParsesValidCsv(): void
    {
        $builder = self::createMock(TransportBuilder::class);
        $builder->method('build')->willReturnCallback(function (TransportDto $dto) {
            return new \App\Entity\Transport\Car(
                $dto->type,
                $dto->brand ?? '',
                $dto->photoFileName ?? '',
                (int)($dto->passengerSeatsCount ?? 0),
                (float)($dto->carrying ?? 0)
            );
        });

        $csv = <<<CSV
Тип,Марка,Фото,Количество пассажирских мест,Размеры кузова ДхШхВ,Грузоподъемность,Дополнительно
car,Ford Focus,ff.png,4,,1.2,
CSV;

        $filePath = __DIR__.'/../Fixtures/test.csv';
        file_put_contents($filePath, $csv);

        $parser = new \App\Service\TransportCSVParser(
            dirname($filePath),
            $builder,
            new \App\Factory\CSVReaderFactory()
        );

        $result = $parser->parse('test.csv');

        $this->assertCount(1, $result);
        $this->assertInstanceOf(\App\Entity\Transport\Car::class, $result[0]);
        $this->assertSame('Ford Focus', $result[0]->getBrand());

        unlink($filePath);
    }


}
