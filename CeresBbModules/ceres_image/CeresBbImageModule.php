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
        $image_id = $this->settings->image_upload; // Retrieve single image ID
        if (!empty($image_id)) {
            $image_url = wp_get_attachment_url($image_id);
            if ($image_url) {
                echo FLBuilder::render_module_html('photo', array(
                    'crop'         => false,
                    'photo_url'    => $image_url,
                    'photo_source' => 'url',
                    'caption'      => 'test image',
                    'show_caption' => $this->settings->caption_position === 'hover' ? 'hover':'below',
                    'attributes'   => array(
                        'width'  => $this->settings->width,
                        'height' => $this->settings->width
                    ),
                ));
            }
        } else {
            echo '<p>No image uploaded or file not found.</p>';
        }
    }




    private function render_video() {
        $video_embed = isset($this->settings->video_upload) ? $this->settings->video_upload : '';

        $video_settings = array(
            'video_type'       => 'embed',
            'embed_code'       => $video_embed,
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
                            'image'      => array(
                                'fields'    => array( 'image_upload' ),
                            ),
                            'video'      => array(
                                'fields'    => array( 'video_upload' ),
                            ),
                        ),
                        'help'          => 'Note: DPLA items cannot be used as embedded media'
                    ),
                    'image_upload' => array(
                        'type'  => 'photo',
                        'label' => __('Upload Image', 'fl-builder'),
                    ),
                    'video_upload' => array(
                        'type'  => 'text',
                        'label' => __('Upload Video (Embed Code)', 'fl-builder'),
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
                    'width'              => array(
                        'type'       => 'unit',
                        'label'      => __( 'Width', 'fl-builder' ),
                        'responsive' => true,
                        'units'      => array(
                            'px',
                            'vw',
                            '%',
                        ),
                        'slider'     => array(
                            'px' => array(
                                'min'  => 0,
                                'max'  => 1000,
                                'step' => 10,
                            ),
                        ),
                        'preview'    => array(
                            'type'      => 'css',
                            'selector'  => '.fl-photo-img',
                            'property'  => 'width',
                            'important' => true,
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
