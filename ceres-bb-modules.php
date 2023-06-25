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

add_action( 'init', 'ceres_load_bb_simple' );
add_action('init' , 'ceres_bb_testing');

function ceres_load_bb_simple() {
    if ( class_exists( 'FLBuilder' ) ) {
        require_once 'CeresBbModules/ceres_simple/CeresBbSimpleModule.php';
        require_once 'CeresBbModules/ceres_boosted/CeresBbBoostedModule.php';
    }

}

/* for the testing to get to `ceres-test-script.php` */

function ceres_bb_testing() {
    $regex = 'ceres-test-script/?$';
    $query = CERES_BB_MODULES_DIR . '/ceres-test-script.php';
    add_rewrite_rule($regex, $query);
}
//wp-content/plugins/CERES-BB-Modules/

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
