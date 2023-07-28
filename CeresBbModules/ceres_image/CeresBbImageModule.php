<?php
namespace Ceres\BeaverBuilder\Module;
require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class ImageModule extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Image BB module', 'fl-builder' ),
            'description'     => __( 'Custom Image Module', 'fl-builder' ),
            'group'           => __( 'CERES Classic', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_image',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_image',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

        $this->add_css('input-form', $this->url . 'includes/input-form.css');
    }

    public function test() {
        return "image test";
    }

    public function render()
    {
        $settings = $this->settings;

        $imageSize = $settings->image_size;
        $displayVideo = (bool) $settings->display_mode === 'video';
        $displayIssuu = (bool) $settings->display_issuu;
        $imageAlignment = $settings->image_alignment;
        $captionAlign = $settings->caption_align;
        $captionPosition = $settings->caption_position;
        $zoomMode = $settings->zoom_mode;
        $zoomPosition = $settings->zoom_position;
        $enableZoom = ($zoomMode === 'zoom-in' || $zoomMode === 'zoom-out');

        ob_start();

        $variables = array(
            'imageSize' => $imageSize,
            'displayVideo' => $displayVideo,
            'displayIssuu' => $displayIssuu,
            'imageAlignment' => $imageAlignment,
            'captionAlign' => $captionAlign,
            'captionPosition' => $captionPosition,
            'enableZoom' => $enableZoom,
            'zoomPosition' => $zoomPosition,
        );

        extract($variables);
        include plugin_dir_path(__FILE__) . '/includes/input-form.php';

        $output = ob_get_clean();

        echo $output;
    }

    public function enqueue_scripts()
    {
        $this->add_css('input-form', $this->url . 'includes/input-form.css');
    }

}

FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\ImageModule', array(
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
                        'default' => "85",
                        'label'         => __( 'Image Size', 'fl-builder' ),
                        'options'       => Options::itemOptions()['image-size'],
                    ),
                    'display_mode'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Display Mode', 'fl-builder' ),
                        'default'       => 'image',
                        'options'       => array(
                            'image'     => __( 'Image Only', 'fl-builder' ),
                            'video'     => __( 'Video Only', 'fl-builder' ),
                            'both'      => __( 'Both Image and Video', 'fl-builder' ),
                        ),
                        'toggle'        => array(
                            'both'      => array(
                                'fields'    => array( 'display_issuu' ),
                            ),
                        ),
                        'help'          => 'Note: DPLA items cannot be used as embedded media'
                    ),
                    'display_issuu'  => array(
                        'type'          => 'checkbox',
                        'label'         => __( 'Display Issuu', 'fl-builder' ),
                        'help'          => 'Note: Only for DRS items. Requires special metadata.'
                    ),
                    'image_alignment'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Image Alignment', 'fl-builder' ),
                        'options'       => Options::itemOptions()['image-alignment'],
                    ),
                    'caption_align'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Caption Alignment', 'fl-builder' ),
                        'options'       =>  Options::itemOptions()['caption-align'],
                        'help'          => 'Allow the text to float around the image by floating it to one side.'
                    ),
                    'caption_position'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Caption Position', 'fl-builder' ),
                        'options'       => array(
                            'below' => 'Below',
                            'hover' => 'Over Image on Hover',
                        ),
                    ),
                    'zoom_mode'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Zoom Mode', 'fl-builder' ),
                        'default'       => 'none',
                        'options'       => array(
                            'none'      => __( 'None', 'fl-builder' ),
                            'zoom-in'   => __( 'Zoom In', 'fl-builder' ),
                            'zoom-out'  => __( 'Zoom Out', 'fl-builder' ),
                        ),
                        'toggle'        => array(
                            'zoom-in'   => array(
                                'fields'    => array( 'zoom_position' ),
                            ),
                            'zoom-out'  => array(
                                'fields'    => array( 'zoom_position' ),
                            ),
                        ),
                    ),
                    'zoom_position'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Zoom Position', 'fl-builder' ),
                        'options'       => Options::itemOptions()['zoom-position'],
                    ),
                ),
            ),
        ),
    ),
) );
