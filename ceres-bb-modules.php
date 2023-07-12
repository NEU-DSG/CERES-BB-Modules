<?php

/**
 * Plugin Name: CERES BeaverBuilder Modules
 * Plugin URI: https://github.com/NEU-DSG/?????
 * Description: Custom CERES module for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Aadesh Mallya, Patrick Murray-John, and the NU Digital Scholarship Group
 * Author URI: https://dsg.northeastern.edu/
 */
define( 'CERES_BB_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'CERES_BB_MODULES_URL', plugins_url( '/', __FILE__ ) );

function my_load_module_examples() {
    if ( class_exists( 'FLBuilder' ) ) {
        // Include your custom modules here.

    }
}
add_action( 'init', 'ceres_load_bb_simple' );

function ceres_load_bb_simple() {
    if ( class_exists( 'FLBuilder' ) ) {
        require_once 'CeresBbModules/ceres_simple/CeresBbSimpleModule.php';
        require_once 'CeresBbModules/ceres_boosted/CeresBbBoostedModule.php';
        require_once 'CeresBbModules/ceres_tmodule/CeresBbTModule1.php';
        require_once 'CeresBbModules/ceres_table/CeresBbArrayTableModule.php';
        require_once 'CeresBbModules/ceres_drs/CeresBbDynamicTableModule.php';
    }

}


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
