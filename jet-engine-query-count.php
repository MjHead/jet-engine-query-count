<?php
/*
Plugin Name: JetEngine - Query Count
Plugin URI: #
Description: Add a macros to calculate sum of values in some column in query results.
Version: 1.0
Author: Crocoblock
Author URI: #
License: GPL2
*/

add_action( 'jet-engine/register-macros', function() {
	require_once plugin_dir_path( __FILE__ ) . 'macros.php';
	new Jet_Engine_Query_Count_Macros();
} );
