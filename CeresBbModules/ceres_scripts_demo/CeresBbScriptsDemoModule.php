<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;
use Ceres\BeaverBuilder\Utility\Options;

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


class ScriptsDemo extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Scripts Demo', 'fl-builder' ),
            'description'     => __( 'Just demoing scripts for options', 'fl-builder' ),
            'group'           => __( 'CERES Classic', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_scripts_demo',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_scripts_demo',
            'icon'            => 'button.svg',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
    }

    public function showOptionValues() {
         return Options::itemOptions();
        // return Options::mapOptions();
        // return Options::tileGalleryOptions();
        // return Options::gallerySliderOptions();
        // return Options::mediaPlaylistOptions();
        // return Options::itemOptions();
    }
}

//use expanded classname to register the module
FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\ScriptsDemo', array(
    'my-tab-1'      => array(
    'title'         => __( 'Tab 1', 'fl-builder' ),
    'sections'      => array(
        'my-section-1'  => array(
        'title'         => __( 'Section 1', 'fl-builder' ),
        'fields'        => array(
            'text'     => array(
            'type'          => 'text',
            'label'         => __( 'Text Field 1', 'fl-builder' ),
            ),
        )
        )
    )
    )
) );
