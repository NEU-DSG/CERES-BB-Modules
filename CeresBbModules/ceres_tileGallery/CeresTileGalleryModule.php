<?php
namespace Ceres\BeaverBuilder\Module;
use Ceres\BeaverBuilder\Utility\Options;

require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class TileGallery extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Tile Gallery module', 'fl-builder' ),
            'description'     => __( 'Custom Tile Gallery Module', 'fl-builder' ),
            'group'           => __( 'CERES Legacy', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_tileGallery',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_tileGallery',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

    }

    public function render()
    {
        $settings = $this->settings;

        // Set Gallery module properties
        $settings->photos = $this->settings->photos;
        $settings->click_action = 'lightbox';
        $settings->layout = 'collage';
        $settings->photo_size = '200';
        $settings->photo_spacing = '20';
        $settings->show_caption = 'below';
        $settings->lightbox_image_size = $this->settings->lightbox_image_size;

        // Render the Gallery module
        FLBuilder::render_module_html('gallery',$settings);
    }

}

FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\TileGallery', array(
    'general'      => array(
        'title'         => __( 'General', 'fl-builder' ),
        'sections'      => array(
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
                    'photos'              => array(
                        'type'        => 'multiple-photos',
                        'label'       => __( 'Photos', 'fl-builder' ),
                        'connections' => array( 'multiple-photos' ),
                    ),
                    'lightbox_image_size' => array(
                        'type'    => 'photo-sizes',
                        'label'   => __( 'Lightbox Photo Size', 'fl-builder' ),
                        'default' => 'large',
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
    'multiple'      => array( // Tab
        'title'         => __('DRS Item', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __( 'DRS Items', 'fl-builder' ),
                'fields'        => array(
                    'link_field1'     => array(
                        'type'          => 'link',
                        'label'         => __('Search for an item', 'fl-builder')
                    )
                )
            )
        )
    ),
    'toggle'      => array( // Tab
        'title'         => __('DPLA Items', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __( 'DPLA Items', 'fl-builder' ),
                'fields'        => array(
                    'link_field1'     => array(
                        'type'          => 'link',
                        'label'         => __('Search for an item', 'fl-builder')
                    )
                )
            )
        )
    ),
    'include'      => array( // Tab
        'title'         => __('Local Items', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __( 'Local Items', 'fl-builder' ),
                'fields'        => array(
                    'editor_field'   => array(
                        'type'          => 'editor',
                        'label'         => 'Add or browse local items',
                        'media_buttons' => true,
                        'rows'          => 10
                    )
                )
            )
        )
    ),
) );
