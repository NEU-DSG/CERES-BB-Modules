<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;
use Ceres\BeaverBuilder\Utility\Options;

require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class ShortcodeConversion extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Shortcode BB module', 'fl-builder' ),
            'description'     => __( 'Just Testing', 'fl-builder' ),
            'group'           => __( 'CERES Boosted', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_drs',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_drs',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));
    }

    public function test() {
        $settings = $this->settings;
        $shortcode = isset($settings->shortcode) ? $settings->shortcode : '';
        if (!empty($shortcode)) {
            $shortcode_data = $this->parse_toolkit_shortcode($shortcode)[0];
            if (!empty($shortcode_data)) {
                echo do_shortcode($shortcode);
            } else {
                echo 'No valid shortcode found.';
            }
        }
    }

    public function update($settings) {
        $shortcode = isset($settings->shortcode) ? $settings->shortcode : '';
        $parsedAttributes = $this->parse_toolkit_shortcode($shortcode);

        if (!empty($parsedAttributes)) {
            $parsedAttributes = $parsedAttributes[0]['settings'];

            foreach ($parsedAttributes as $key => $value) {
                $settings->$key = $value;
            }
        }

        return $settings;
    }

    function parse_toolkit_shortcode($content) {
        $pattern = '/\[(\w+)([^\]]*)\]/';

        $shortcode_data = array();

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $shortcode_name = $match[1];
            $attributes = $match[2];

            $attribute_pattern = '/(\w+)="([^"]*)"/';

            $shortcode_attributes = array();

            preg_match_all($attribute_pattern, $attributes, $attribute_matches, PREG_SET_ORDER);

            foreach ($attribute_matches as $attribute_match) {
                $key = strtolower($attribute_match[1]);
                $value = $attribute_match[2];
                $shortcode_attributes[$key] = $value;
            }

            $shortcode_data[] = array(
                'name' => $shortcode_name,
                'settings' => $shortcode_attributes,
            );
        }

        return $shortcode_data;
    }

}

FLBuilder::register_module('Ceres\BeaverBuilder\Module\ShortcodeConversion', array(
    'general' => array(
        'title'    => __('General', 'fl-builder'),
        'sections' => array(
            'config' => array(
                'title'  => __('Table Configuration', 'fl-builder'),
                'fields' => array(
                    'shortcode' => array(
                        'type'          => 'text',
                        'label'         => __('Shortcode', 'fl-builder'),
                    ),
                    'select_option' => array(
                        'type'          => 'select',
                        'label'         => __('Identifier', 'fl-builder'),
                        'default'       => '',
                        'options'       => array(
                            ''         => __('Select an option', 'fl-builder'),
                            'drstk_media'      => __('drstk_media', 'fl-builder'),
                            'drstk_single' => __('drstk_single', 'fl-builder'),
                            'drstk_slider' => __('drstk_slider', 'fl-builder'),
                            'drstk_title' => __('drstk_title', 'fl-builder'),
                            'drstk_map' => __('drstk_map', 'fl-builder'),
                            'drstk_timeline' => __('drstk_timeline', 'fl-builder')
                        ),
                        'toggle'        => array(
                            '' => array(),
                            'drstk_media'  => array(
                                'fields' => array('id', 'height', 'width')
                            ),
                            'drstk_single'  => array(
                                'fields' => array('id', 'image_size', 'display_mode', 'display_issuu', 'image_alignment', 'caption_align', 'caption_position', 'zoom_mode', 'zoom_position')
                            ),
                            'drstk_slider'  => array(
                                'fields' => array('id', 'image_upload', 'image_size', 'autorotate', 'next_prev_buttons', 'dot_pager', 'rotation_speed', 'max_height')
                            ),
                            'drstk_title'  => array(
                                'fields' => array('id', 'style_type', 'text_align', 'cell_height', 'cell_width', 'photos', 'lightbox_image_size')
                            ),
                        ),
                    ),
                    'id' => array(
                        'type'          => 'text',
                        'label'         => __('IDs', 'fl-builder'),
                    ),
                    'image_upload' => array(
                        'type'  => 'photo',
                        'label' => __( 'Upload Images', 'fl-builder' ),
                        'help'  => __( 'Upload images for the gallery.', 'fl-builder' ),
                        'multiple' => true,
                    ),
                    'image_size'     => array(
                        'type'          => 'select',
                        'default'       => "",
                        'label'         => __( 'Image Size', 'fl-builder' ),
                        'options'       => Options::gallerySliderOptions()['image-size'],
                    ),
                    'autorotate'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Auto Rotate', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['autorotate'] ? 'yes' : 'no',
                        'options'       => array(
                            'yes' => __( 'Yes', 'fl-builder' ),
                            'no'  => __( 'No', 'fl-builder' ),
                        ),
                    ),
                    'next_prev_buttons'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Next/Prev Buttons', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['next/prev buttons'] ? 'yes' : 'no',
                        'options'       => array(
                            'yes' => __( 'Yes', 'fl-builder' ),
                            'no'  => __( 'No', 'fl-builder' ),
                        ),
                    ),
                    'dot_pager'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Dot Pager', 'fl-builder' ),
                        'default'       => Options::gallerySliderOptions()['dot pager'] ? 'yes' : 'no',
                        'options'       => array(
                            'yes' => __( 'Yes', 'fl-builder' ),
                            'no'  => __( 'No', 'fl-builder' ),
                        ),
                    ),
                    'rotation_speed'  => array(
                        'type'          => 'text',
                        'label'         => __( 'Rotation Speed', 'fl-builder' ),
                        'default'       => '',
                    ),
                    'max_height'  => array(
                        'type'          => 'text',
                        'label'         => __( 'Max Height', 'fl-builder' ),
                        'default'       => '',
                    ),
                    'image_size'     => array(
                        'type'          => 'select',
                        'default'       => '',
                        'label'         => __( 'Image Size', 'fl-builder' ),
                        'options'       => Options::itemOptions()['image-size'],
                    ),
                    'display_mode'  => array(
                        'type'          => 'select',
                        'label'         => __( 'Display Mode', 'fl-builder' ),
                        'default'       => '',
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
                        'type'          => 'select',
                        'label'         => __( 'Display Issuu', 'fl-builder' ),
                        'help'          => 'Note: Only for DRS items. Requires special metadata.',
                        'options' => array(
                            'yes' => __( 'true', 'fl-builder' ),
                            'no'  => __( 'false', 'fl-builder' ),
                        )
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
                    'height' => array(
                        'type'          => 'text',
                        'label'         => __( 'Height', 'fl-builder' ),
                        'default'       => '',
                        'help'          => "(Enter in pixels or %, Default is 270)"
                    ),
                    'width' => array(
                        'type'          => 'text',
                        'label'         => __( 'Width', 'fl-builder' ),
                        'default'       => '',
                        'help'          => "(Enter in pixels or %, Default is 100%)"
                    ),
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
                        'default'       => '',
                    ),
                    'cell_width'  => array(
                        'type'          => 'text',
                        'label'         => __( 'Cell Width', 'fl-builder' ),
                        'default'       => '',
                    ),
                    'photos'              => array(
                        'type'        => 'multiple-photos',
                        'label'       => __( 'Photos', 'fl-builder' ),
                        'connections' => array( 'multiple-photos' ),
                    ),
                    'lightbox_image_size' => array(
                        'type'    => 'photo-sizes',
                        'label'   => __( 'Lightbox Photo Size', 'fl-builder' ),
                        'default' => '',
                    ),
                ),
            ),
        ),
    ),
));
