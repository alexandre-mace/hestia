<?php

namespace App\Service;

use App\Entity\Site;

class RecyclingRateCalculator 
{
	public function calculate(Site $site)
	{
		$recycledMaterialQuantitiesArray = [];
		$totalMaterialQuantitiesArray = [];

		$siteMaterials = $site->getSiteMaterials();

		foreach ($siteMaterials as $siteMaterial) {
			switch ($siteMaterial->getMaterial()->getIsRecycled()) {
				case true:
					$recycledMaterialQuantitiesArray[] = $siteMaterial->getQuantity();
					$totalMaterialQuantitiesArray[] = $siteMaterial->getQuantity();
					break;
				case false:
					$totalMaterialQuantitiesArray[] = $siteMaterial->getQuantity();					
					break;
			}
		}
        return array_sum($totalMaterialQuantitiesArray) > 0 ?
		((array_sum($recycledMaterialQuantitiesArray) / array_sum($totalMaterialQuantitiesArray)) * 100 ) :
		0;
	}
}