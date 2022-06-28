<?php

namespace App\Service\Shop\Import;

final class ImportShopFromLesHabituesApiService extends ImportShopFromApi
{
	private $lesHabituesApiUrl;
	private $lesHabituesApiShopEndpoint;

	public function __construct(
		string $lesHabituesApiUrl,
		string $lesHabituesApiShopEndpoint
	) {
		$this->lesHabituesApiUrl = $lesHabituesApiUrl;
		$this->lesHabituesApiShopEndpoint = $lesHabituesApiShopEndpoint;
	}

	final protected function getShopDataFromApi()
	{
	}
}