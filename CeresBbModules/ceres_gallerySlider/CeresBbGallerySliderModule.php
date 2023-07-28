<?php
namespace Ceres\BeaverBuilder\Module;
require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class GallerySlider extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Gallery Slider', 'fl-builder' ),
            'description'     => __( 'Custom Gallery Slider Module', 'fl-builder' ),
            'group'           => __( 'CERES Classic', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_gallerySlider',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_gallerySlider',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

    }

    public function test() {
        return "slider test";
    }

}

FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\GallerySlider', array(
    'general'      => array(
        'title'         => __( 'General', 'fl-builder' ),
        'sections'      => array(
            'DRS Items' => array(
                'title'         => __( 'DRS Items', 'fl-builder' ),
                'fields'        => array(
                    'link_field1'     => array(
                        'type'          => 'link',
                        'label'         => __('Search for an item', 'fl-builder')
                    )
                )
            ),
            'DPLA Items' => array(
                'title'         => __( 'DPLA Items', 'fl-builder' ),
                'fields'        => array(
                    'link_field2'     => array(
                        'type'          => 'link',
                        'label'         => __('Search for an item', 'fl-builder')
                    )
                )
            ),
            'Local Items' => array(
                'title'         => __( 'Local Items', 'fl-builder' ),
                'fields'        => array(
                    'editor_field'   => array(
                        'type'          => 'editor',
                        'label'         => 'Add or browse local items',
                        'media_buttons' => true,
                        'rows'          => 10
                    )
                )
            ),
            'Selected Items' => array(
                'title'         => __( 'Selected Items', 'fl-builder' ),
            ),
            'Settings'  => array(
                'title'         => __( 'Settings', 'fl-builder' ),
                'fields'        => array(
                    'image_size'     => array(
                        'type'          => 'select',
                        'default'       => "85",
                        'label'         => __( 'Image Size', 'fl-builder' ),
                        'options'       => Options::gallerySliderOptions()['image-size'],
                    ),
                    'autorotate'  => array(
                        'type'          => 'select', // Change to 'select' field
                        'label'         => __( 'Auto Rotate', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['autorotate'] ? 'yes' : 'no', // Use 'yes' or 'no' as the options
                        'options'       => array(
                            'yes' => __( 'Yes', 'fl-builder' ),
                            'no'  => __( 'No', 'fl-builder' ),
                        ),
                    ),
                    'next_prev_buttons'  => array(
                        'type'          => 'select', // Change to 'select' field
                        'label'         => __( 'Next/Prev Buttons', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['next/prev buttons'] ? 'yes' : 'no', // Use 'yes' or 'no' as the options
                        'options'       => array(
                            'yes' => __( 'Yes', 'fl-builder' ),
                            'no'  => __( 'No', 'fl-builder' ),
                        ),
                    ),
                    'dot_pager'  => array(
                        'type'          => 'select', // Change to 'select' field
                        'label'         => __( 'Dot Pager', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['dot pager'] ? 'yes' : 'no', // Use 'yes' or 'no' as the options
                        'options'       => array(
                            'yes' => __( 'Yes', 'fl-builder' ),
                            'no'  => __( 'No', 'fl-builder' ),
                        ),
                    ),
                    'rotation_speed'  => array(
                        'type'          => 'text',
                        'label'         => __( 'Rotation Speed', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['rotation speed'],
                    ),
                    'max_height'  => array(
                        'type'          => 'text',
                        'label'         => __( 'Max Height', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['max height'],
                    ),
                ),
            ),
        ),
    ),
) );
