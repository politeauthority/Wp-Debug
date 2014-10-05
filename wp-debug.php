<?php
/*
Plugin Name: Wp-Debug
Plugin URI: https://github.com/politeauthority/WpDebug/
Description: 
Version: .01
Author: Alix Fullerton
Author URI: http://www.politeauthority.com/
Release Date: 2014-10-05
*/

define( 'WP_DEBUG_PATH', plugin_dir_path( __FILE__ ) );
require WP_DEBUG_PATH . 'includes/wp-debug.php';


if( is_admin() ){
  require WP_DEBUG_PATH . 'includes/wp-debug-admin.php';
  new WpDebugAdmin();
}
