<?php
/**
 * @package Gman Custom Endpoint
 */
/*
/*
Plugin Name: CLASS Gman Custom Endpoint
Plugin URI: https://www.venadoblanco.com
Description: Create and make available a custom NOT A REST endpoint "http://localhost/wordpress/exercise/inpsyde". When a visitor navigates to that endpoint, the plugin send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.The plugin will parse the JSON response and will use it to build and display an HTML table.
Version: 0.1.0
Author: German Villegas
Author URI: https://www.venadoblanco.com
License:     GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This progrm is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or  any later version.

This program is distribuited in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. see the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.

Copyright 2005-2015 automattic, Inc.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if (!defined ('ABSPATH')) {
    die;
}



// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define ( 'WP_DEBUG', false);
define ( 'WP_DEBUG_LOG', false);
define ( 'WP_DEBUG_DISPLAY', false);

define( 'GmanCustomEndpoint__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( GmanCustomEndpoint__PLUGIN_DIR . 'class.gmanEndPoint.php' );
require_once( GmanCustomEndpoint__PLUGIN_DIR . 'class.gmanEndPoint.processRequest.php' );


add_action( 'init', array( 'gmanEndPoint', 'init' ) );
add_action( 'parse_request', array( 'gmanEndPoint', 'endpoint' ) , 0);