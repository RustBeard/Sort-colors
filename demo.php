<!doctype html>
<?php
function printarray($data) {
	echo '<div style="text-align: left; max-height: 500px; overflow: auto; margin: 3rem auto;">';
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	echo '</div>';
};

include 'rb-sort-colors.php';
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sort colors with php</title>

	<style>
		body {
			font-family: Tahoma, sans-serif;
		}

		#site-wrapper {
			width: 1200px;
			max-width: 100%;
			margin: 0 auto;
		}

		#unsorted, #sorted {
			display: flex;
			width: 100%;
			height: 100px;
			margin-bottom: 50px;
		}

		#unsorted .color, #sorted .color {
			flex: 1;
			height: 100%;
		}
	</style>
</head>

<?php 
// generating random array of colors
$unsorted = array();
for($i=0; $i<200; $i++) {
	$unsorted[$i] = array('r'=>rand(0,255), 'g'=>rand(0,255), 'b'=>rand(0,255));
}
?>

<body>
	<div id="site-wrapper">
		<h3>Unsorted: </h3>
		<div id="unsorted">
			<?php foreach($unsorted as $color) : ?>
			<div class="color" style="background-color: rgb(<?php echo $color['r'].', '.$color['g'].', '.$color['b']; ?>);"></div>
			<?php endforeach; ?>
		</div>
		<h3>Sorted: </h3>
		<div id="sorted">
			<?php RBsortColors($unsorted, 'color'); ?>
		</div>
	</div>
</body>