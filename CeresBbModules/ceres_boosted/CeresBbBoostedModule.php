<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;

class Boosted extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Boosted BB module', 'fl-builder' ),
            'description'     => __( 'Just Testing', 'fl-builder' ),
            'group'           => __( 'CERES Boosted', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_boosted',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_boosted',
            'icon'            => 'button.svg',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
    }

    public function test() {
        return "WHEEEE!";
    }
}

//use expanded classname to register the module
FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\Boosted', array(
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
