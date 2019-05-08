<?php

// The poorest reccomended security I ever saw. But let it be here.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function simple_categorized_gallery__get_newest_year_tag(){
	$newest_year = null;  // Lets take this as a base year.
	$country_gallery_years = get_terms([
		'taxonomy' => SIMPLE_CATEGORIZED_GALLERY__TAXONOMY_YEARS,
		'hide_empty' => false
	]);
	
	foreach ($country_gallery_years as $year_tag) {
	
		if($newest_year === null){
			$newest_year = $year_tag;
			continue;
		}

		if((int)$year_tag->slug > (int)$newest_year->slug){
			$newest_year = $year_tag;
			continue;
		}
		
	}

	return $newest_year;
}
