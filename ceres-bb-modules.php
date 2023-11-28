<?php

/**
 * Plugin Name: CERES BeaverBuilder Modules
 * Plugin URI: https://github.com/NEU-DSG/?????
 * Description: Custom CERES module for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Aadesh Mallya, Patrick Murray-John, and the NU Digital Scholarship Group
 * Author URI: https://dsg.northeastern.edu/
 */

use function Ceres\BeaverBuilder\Utility\getMockShortcodeResponse;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 
require_once( 'utility/mockDrstkShortcodes.php');

define( 'CERES_BB_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'CERES_BB_MODULES_URL', plugins_url( '/', __FILE__ ) );
define( 'CERES_ROOT_DIR', dirname(__FILE__, 2) . '/drs-toolkit-wp-plugin/libraries/Ceres');

add_action( 'init', 'ceres_load_bb_simple' );

function ceres_load_bb_simple() {
    if ( class_exists( 'FLBuilder' ) ) {
        require_once( 'CeresBbModules/ceres_shortcode/CeresBbShortcodeModule.php' );
        require_once( 'CeresBbModules/ceres_drs/CeresBbDynamicTableModule.php');
        require_once( 'CeresBbModules/ceres_image/CeresBbImageModule.php');
        require_once( 'CeresBbModules/ceres_gallerySlider/CeresBbGallerySliderModule.php');
        require_once( 'CeresBbModules/ceres_mediaPlaylist/CeresMediaPlaylistModule.php');
        require_once( 'CeresBbModules/ceres_tileGallery/CeresTileGalleryModule.php');
        
    }
}


