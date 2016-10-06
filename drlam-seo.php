<?php
/**
 * @package DRLAMSEO\Main
 */

/**
 * Plugin Name: DRLAM SEO
 * Version: 1.0.0
 * Plugin URI: 
 * Description: 
 * Author: Michael Butarbutar
 * Author URI: https://drlam.com/
 * Text Domain: drlam-seo
 * Domain Path: /languages/
 * License: GPL v3
 */

/**
 * DRLAM SEO Plugin
 * Copyright (C) 2016, Michael Butarbutar - indigomike7@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'DRLAMSEO_FILE' ) ) {
	define( 'DRLAMSEO_FILE', __FILE__ );
}

if ( !defined( 'WP_CONTENT_URL' ) )
define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( !defined( 'WP_CONTENT_DIR' ) )
define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( !defined( 'WP_PLUGIN_URL' ) )
define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( !defined( 'WP_PLUGIN_DIR' ) )
define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

// Load the drlam SEO Plugin.
require_once( dirname( DRLAMSEO_FILE ) . '/drlam-seo-main.php' );


?>