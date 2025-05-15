<?php
namespace Ceres\BeaverBuilder\Module;
use Ceres\BeaverBuilder\Utility\Options;

require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;
use FLContentSliderModule;

class GallerySlider extends FLBuilderModule {

    public function enqueue_content_slider_assets() {
        if (class_exists('FLBuilder')) {
            wp_enqueue_script('content-slider');
            wp_enqueue_style('content-slider');
        }
    }

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Gallery Slider', 'fl-builder' ),
            'description'     => __( 'Custom Gallery Slider Module', 'fl-builder' ),
            'group'           => __( 'CERES v1', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_gallerySlider',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_gallerySlider',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

        add_action('wp_enqueue_scripts', array($this, 'enqueue_content_slider_assets'));

        $this->add_css( 'jquery-bxslider' );
        $this->add_js( 'jquery-bxslider' );
    }

    public function render()
    {
        $images = $this->settings->image_upload;

        // Generate slides based on uploaded images
        $slides = array();

        if (!empty($images)) {
            foreach ($images as $image_id) {
                $image_url = wp_get_attachment_url($image_id);

                if ($image_url) {
                    $slide = (object) array(
                        'content_layout' => 'photo',
                        'bg_layout' => 'photo',
                        'bg_photo' => $image_url,
                        'fg_photo' => $image_url,
                        'bg_photo_src' => $image_url,
                        'fg_photo_src' => $image_url,
                        'r_photo_type' => 'main',
                        'cta_type' => 'none'
                    );

                    $slides[] = $slide;
                }
            }
        }

        $settings = new \stdClass();
        $settings->slides = $slides;
        $settings->auto_play = 'Yes';
        $settings->auto_hover = 'Yes';
        $settings->shuffle = 'No';
        $settings->loop = 'Yes';
        $settings->dots = 'Yes';
        $settings->speed = '1';
        $settings->arrows = true;

        ob_start();

        ?>
        <div class="fl-node-<?php echo $this->node; ?>">
            <div class="fl-content-slider">
                <div class="fl-content-slider-slides">
                    <?php foreach ($slides as $slide) : ?>
                        <div class="fl-content-slider-slide">
                            <img src="<?php echo $slide->bg_photo; ?>" alt="Slide Image">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $('.fl-node-<?php echo $this->node; ?> .fl-content-slider-slides').bxSlider({
                    auto: <?php echo $settings->auto_play === 'Yes' ? 'true' : 'false'; ?>,
                    pause: <?php echo $settings->auto_hover === 'Yes' ? 'true' : 'false'; ?>,
                    shuffle: <?php echo $settings->shuffle === 'Yes' ? 'true' : 'false'; ?>,
                    infiniteLoop: <?php echo $settings->loop === 'Yes' ? 'true' : 'false'; ?>,
                    pager: <?php echo $settings->dots === 'Yes' ? 'true' : 'false'; ?>,
                    speed: <?php echo (float) $settings->speed; ?> * 1000,
                    nextText: '<i class="bx bx-chevron-right"></i>',
                    prevText: '<i class="bx bx-chevron-left"></i>',
                    controls: <?php echo $settings->arrows ? 'true' : 'false'; ?>
                });
            });
        </script>
        <?php

        echo ob_get_clean();
    }

}

FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\GallerySlider', array(
    'general'      => array(
        'title'         => __( 'General', 'fl-builder' ),
        'sections'      => array(
            'Settings'  => array(
                'title'         => __( 'Settings', 'fl-builder' ),
                'fields'        => array(
                    'image_upload' => array(
                        'type'  => 'photo',
                        'label' => __( 'Upload Images', 'fl-builder' ),
                        'help'  => __( 'Upload images for the gallery.', 'fl-builder' ),
                        'multiple' => true,
                    ),
                    'image_size'     => array(
                        'type'          => 'select',
                        'default'       => "85",
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
