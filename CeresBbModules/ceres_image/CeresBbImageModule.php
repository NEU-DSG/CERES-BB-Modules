<?php
namespace Ceres\BeaverBuilder\Module;
use Ceres\BeaverBuilder\Utility\Options;

require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class ImageModule extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Image BB module', 'fl-builder' ),
            'description'     => __( 'Custom Image Module', 'fl-builder' ),
            'group'           => __( 'CERES Legacy', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_image',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_image',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));
    }

    public function render() {
        $settings = $this->settings;

        switch($settings->display_mode) {
            case 'image':
                $this->render_image();
                break;
            case 'video':
                $this->render_video();
                break;
            case 'both':
                $this->render_image();
                $this->render_video();
                break;
            default:
                $this->render_image();
                break;
        }
    }

    private function render_image() {
        $img_settings = array(
            'photo_src' => 'https://cdn.vox-cdn.com/thumbor/KVLkvW-aKkZ4A3itAooco3lF6hw=/0x0:1920x1080/1200x800/filters:focal(807x387:1113x693)/cdn.vox-cdn.com/uploads/chorus_image/image/65447488/succession_s2_ka_1920.0.jpg',
            'photo_alt' => 'Random pic'
        );
        echo FLBuilder::render_module_html('photo', $img_settings);
    }

    private function render_video() {
        $video_settings = array(
            'video_type'   => 'embed',
            'embed_code'   => '<iframe width="560" height="315" src="https://www.youtube.com/embed/NcXsK_u4ixI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',  // replace VIDEO_ID with actual video id
        );

        echo FLBuilder::render_module_html('video', $video_settings);
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
