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
            'group'           => __( 'CERES v1', 'fl-builder' ),
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
        echo FLBuilder::render_module_html('photo', array(
            'crop'         => false,
            'photo_url'        => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png',
            'photo_source'    => 'url',
            'caption' => 'test image',
            'show_caption' => $this->settings->caption_position === 'hover' ? 'hover':'below',
            'attributes' => array(
                'width'=>$this->settings->image_size,
                'height' => $this->settings->image_size
                ),
        ));
    }

    private function render_video() {
        $video_settings = array(
            'video_type'   => 'embed',
            'embed_code'   => '<iframe width="560" height="315" src="https://www.youtube.com/embed/NcXsK_u4ixI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',  // replace VIDEO_ID with actual video id
            'caption_position' => $this->settings->caption_position, // Use caption position from settings
        );

        echo FLBuilder::render_module_html('video', $video_settings);
    }

}

FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\ImageModule', array(
    'general'      => array(
        'title'         => __( 'General', 'fl-builder' ),
        'sections'      => array(
            'Settings'  => array(
                'title'         => __( 'Settings', 'fl-builder' ),
                'fields'        => array(
                    'image_size'     => array(
                        'type'          => 'select',
                        'default'       => '85',
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
    'Selected Items' => array(
        'title'         => __( 'Selected Items', 'fl-builder' ),
        'sections'      => array()
    ),
) );
