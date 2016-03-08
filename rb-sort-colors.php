<?php

function RBsortColors($unsortedArray, $class) {

	// not my function (but with little change) - if you're owner, please send message
	function RGBtoHSV($r, $g, $b) {
		$r = ($r / 255);
		$g = ($g / 255);
		$b = ($b / 255);

		$maxRGB = max($r, $g, $b);
		$minRGB = min($r, $g, $b);
		$chroma = $maxRGB - $minRGB;

		$computedV = 100 * $maxRGB;

		if ($chroma == 0) {
			$computedH = 0;
			$computedS = 0;
		} else {
			$computedS = 100 * ($chroma / $maxRGB);

			if ($r == $minRGB) {
				$h = 3 - (($g - $b) / $chroma);
			}
			elseif ($b == $minRGB) {
				$h = 1 - (($r - $g) / $chroma);
			} else {
				$h = 5 - (($b - $r) / $chroma);
			}

			$computedH = 60 * $h;
		}
		return array('h' => $computedH, 's' => $computedS, 'v' => $computedV);
	}

	function perLightness($r, $g, $b) {
		return ($r*0.21)+($g*0.72)+($b*0.07);
	}


	usort($unsortedArray, function($a, $b) {
		$aLig = perLightness($a['r'], $a['g'], $a['b']);
		$bLig = perLightness($b['r'], $b['g'], $b['b']);

		return $aLig < $bLig ? 1 : -1 ;
	});

	$sorted = array();
	foreach($unsortedArray as $color) {
		$hsv = RGBtoHSV($color['r'], $color['g'], $color['b']);
		$hue = round($hsv['h'], 2);
		$sat = round($hsv['s'], 2);
		$val = round($hsv['v'], 2);

		if($sat < 10) { //grays
			$sorted['grays'][] = array('r'=>$color['r'], 'g'=>$color['g'], 'b'=>$color['b']);
		}
		elseif(($hue < 20) || (($hue >= 345) && ($hue <= 360))) { //reds
			$sorted['reds'][] = array('r'=>$color['r'], 'g'=>$color['g'], 'b'=>$color['b']);
		} 
		elseif(($hue >= 20) && ($hue < 60)) { //oranges n yellows
			$sorted['yellows'][] = array('r'=>$color['r'], 'g'=>$color['g'], 'b'=>$color['b']);
		}
		elseif(($hue >= 60) && ($hue < 175)) { //greens
			$sorted['greens'][] = array('r'=>$color['r'], 'g'=>$color['g'], 'b'=>$color['b']);
		}
		elseif(($hue >= 175) && ($hue < 250)) { //blues
			$sorted['blues'][] = array('r'=>$color['r'], 'g'=>$color['g'], 'b'=>$color['b']);
		}
		elseif(($hue >= 250) && ($hue < 345)) { //purples
			$sorted['purples'][] = array('r'=>$color['r'], 'g'=>$color['g'], 'b'=>$color['b']);
		}
	}

	$sorted = array_merge($sorted['grays'], $sorted['reds'], $sorted['yellows'], $sorted['greens'], $sorted['blues'], $sorted['purples']);


	foreach($sorted as $color) {
		echo '<div class="'.$class.'" style="background-color: rgb('.$color['r'].', '.$color['g'].', '.$color['b'].');"></div>';
	}

}

?>