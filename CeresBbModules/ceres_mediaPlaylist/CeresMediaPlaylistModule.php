<?php
namespace Ceres\BeaverBuilder\Module;
use Ceres\BeaverBuilder\Utility\Options;

require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class MediaPlaylist extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Media Playlist module', 'fl-builder' ),
            'description'     => __( 'Custom Media Playlist Module', 'fl-builder' ),
            'group'           => __( 'CERES Legacy', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_mediaPlaylist',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_mediaPlaylist',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

    }

}

FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\MediaPlaylist', array(
    'general'      => array(
        'title'         => __( 'General', 'fl-builder' ),
        'sections'      => array(
            'Settings'  => array(
                'title'         => __( 'Settings', 'fl-builder' ),
                'fields'        => array(
                    'height' => array(
                        'type'          => 'text',
                        'label'         => __( 'Height', 'fl-builder' ),
                        'default'       => Options::mediaPlaylistOptions()['height'],
                        'help'          => "(Enter in pixels or %, Default is 270)"
                    ),
                    'width' => array(
                        'type'          => 'text',
                        'label'         => __( 'Width', 'fl-builder' ),
                        'default'       => Options::mediaPlaylistOptions()['width'],
                        'help'          => "(Enter in pixels or %, Default is 100%)"
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
