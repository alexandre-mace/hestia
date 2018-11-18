<?php

namespace App\Service;

use App\Entity\Site;
use App\Entity\Label;

class LabelAwarder 
{
	public function award(Site $site)
	{
		$rate = $site->getRecyclingRate();
		if ($rate >= 70) {
			$label = new Label;
		    $site->setLabel($label);

			if ($rate >= 90) {
				$label->setGrade('Or');
				return;
		    } 
		    if ($rate >= 80) {
				$label->setGrade('Argent');
				return;
		    }
		    $label->setGrade('Bronze');
		}
	}
}