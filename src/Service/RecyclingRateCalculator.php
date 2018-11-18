<?php

namespace App\Service;

use App\Entity\Site;

class RecyclingRateCalculator 
{
	public function calculate(Site $site)
	{
		$recycledMaterialQuantities = [];
		$totalMaterialQuantities = [];

		$siteMaterials = $site->getSiteMaterials();

		foreach ($siteMaterials as $siteMaterial) {
			switch ($siteMaterial->getMaterial()->getIsRecycled()) {
				case true:
					$recycledMaterialQuantities[] = $siteMaterial->getQuantity();
					$totalMaterialQuantities[] = $siteMaterial->getQuantity();
					break;
				case false:
					$totalMaterialQuantities[] = $siteMaterial->getQuantity();
					break;
			}
		}
        return array_sum($totalMaterialQuantities) > 0 ?
		((array_sum($recycledMaterialQuantities) / array_sum($totalMaterialQuantities)) * 100 ) :
		0;
	}
}