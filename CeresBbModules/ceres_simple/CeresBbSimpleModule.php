<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;

class Simple extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Simple BB module', 'fl-builder' ),
            'description'     => __( 'Just Testing', 'fl-builder' ),
            'group'           => __( 'CERES', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/',
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
FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\Simple', array(
    'my-tab-1'      => array(
    'title'         => __( 'Tab 1', 'fl-builder' ),
    'sections'      => array(
        'my-section-1'  => array(
        'title'         => __( 'Section 1', 'fl-builder' ),
        'fields'        => array(
            'my-field-1'     => array(
            'type'          => 'text',
            'label'         => __( 'Text Field 1', 'fl-builder' ),
            ),
            'my-field-2'     => array(
            'type'          => 'text',
            'label'         => __( 'Text Field 2', 'fl-builder' ),
            )
        )
        )
    )
    )
) );
