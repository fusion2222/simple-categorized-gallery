<?
/*
 * Plugin Name: Simple categorized gallery
 * Description: Enables layman-proof gallery with categories.
 * Author: Matej Šrubař
 * Author URI:  https://www.exile.sk 
 */

// The poorest reccomended security I ever saw. But let it be here.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


@include '_settings.php';
@include '_content-types.php';
@include '_thumbnail-size.php';
@include '_utils.php';
