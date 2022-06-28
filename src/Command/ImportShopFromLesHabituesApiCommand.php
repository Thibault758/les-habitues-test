<?php

namespace App\Command;

use App\Service\Shop\Import\ImportShopFromApi;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportShopFromLesHabituesApiCommand extends Command
{
    protected static $defaultName = 'app:ImportShopFromLesHabituesApiCommand';
    protected static $defaultDescription = 'Import all shop from LesHabitues API';

    protected $importShopFromLesHabituesApiService;

    public function __construct(
    	string $name = null,
		ImportShopFromApi $importShopFromLesHabituesApiService
	){
		parent::__construct($name);
		$this->importShopFromLesHabituesApiService = $importShopFromLesHabituesApiService;
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
    {
		$io = new SymfonyStyle($input, $output);

    	try {
    		$nbImportedShop = $this->importShopFromLesHabituesApiService->importShop();
			$io->success("$nbImportedShop shops imported with success");
			return Command::SUCCESS;
		} catch (\Exception $e) {
    		$io->error($e->getMessage());
			return Command::FAILURE;
		}
    }
}
