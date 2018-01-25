<?php

$filters = new Tribe\Project\Programs\Filters();
$filter_data = $filters->get_filter_data();


echo '<div id="filter-wrapper">';
	foreach ($filter_data as $value) {
		if ($value['label'] === 'Your Age') {
			$label = 'age';
		} else if ($value['label'] === 'Area of Interest') {
			$label = 'interest';
		} else {
			$label = $value['label'];
		}

		echo '<div class="h300">
				<div class="select collapsed">
			        <div class="shown">' .
			        	$value['label']
			        .'</div><div class="inner-options">';


	        foreach ($value['data'] as $key => $dataval) {
	        	echo '<div class="option" data-' . $label . '="' . $key . '"><div class="inner">'
	        		. $dataval . 
	        	'</div></div>';
	        }

	    echo '</div></div></div>';
	}
echo '</div>';

