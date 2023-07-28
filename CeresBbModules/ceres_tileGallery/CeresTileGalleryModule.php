<?php
namespace Ceres\BeaverBuilder\Module;
require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class TileGallery extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Tile Gallery module', 'fl-builder' ),
            'description'     => __( 'Custom Tile Gallery Module', 'fl-builder' ),
            'group'           => __( 'CERES Classic', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_tileGallery',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_tileGallery',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

    }

    public function test() {
        return "tile gallery test";
    }

}

FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\TileGallery', array(
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
                    'style_type'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Tile Style Type', 'fl-builder' ),
                        'options'       => Options::tileGalleryOptions()['style-type'],
                    ),
                    'text_align'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Text Alignment', 'fl-builder' ),
                        'options'       => Options::tileGalleryOptions()['text-align'],
                    ),
                    'cell_height'  => array(
                        'type'          => 'text',
                        'label'         => __( 'Cell Height', 'fl-builder' ),
                        'default'       => Options::tileGalleryOptions()['cell-height'],
                    ),
                    'cell_width'  => array(
                        'type'          => 'text',
                        'label'         => __( 'Cell Width', 'fl-builder' ),
                        'default'       => Options::tileGalleryOptions()['cell-width'],
                    ),
                ),
            ),
            'metadata'     => array(
                'title'         => __( 'Metadata', 'fl-builder' ),
                'fields'        => array(
                    'metadata'  => array(
                        'type'          => 'multiple',
                        'label'         => __( 'Metadata', 'fl-builder' ),
                        'options'       => Options::tileGalleryOptions()['metadata'],
                    ),
                ),
            ),
        ),
    ),
) );
