<?php

namespace App\Service;

use App\Entity\Site;

class RecyclingRateCalculator 
{
	public function calculate(Site $site)
	{
		$recycledQuantities = [];
		$totalQuantities = [];

		$siteMaterials = $site->getSiteMaterials();

		foreach ($siteMaterials as $siteMaterial) {
			switch ($siteMaterial->getMaterial()->getIsRecycled()) {
				case true:
					$recycledQuantities[] = $siteMaterial->getQuantity();
					$totalQuantities[] = $siteMaterial->getQuantity();
					break;
				case false:
					$totalQuantities[] = $siteMaterial->getQuantity();
					break;
			}
		}
        return array_sum($totalQuantities) > 0 ?
		((array_sum($recycledQuantities) / array_sum($totalQuantities)) * 100 ) :
		0;
	}
}