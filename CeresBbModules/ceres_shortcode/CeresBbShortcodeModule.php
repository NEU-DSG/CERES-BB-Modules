<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;
use Ceres\BeaverBuilder\Utility\Options;
use Ceres\BeaverBuilder\Utility\CeresAdapter;
require_once __DIR__ . '/../../utility/CeresAdapter.php';
require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class ShortcodeConversion extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Shortcode BB module', 'fl-builder' ),
            'description'     => __( 'Just Testing', 'fl-builder' ),
            'group'           => __( 'CERES v2', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_shortcode',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_shortcode',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));
    }

    public function convert() {
        $settings = $this->settings;
        $shortcode = isset($settings->shortcode) ? $settings->shortcode : '';
        if (!empty($shortcode)) {
            $shortcode_data = $this->parse_toolkit_shortcode($shortcode)[0];
            if (!empty($shortcode_data)) {
                $identifier = $shortcode_data['name'];
                $identifier = str_replace("drstk_", "v1_", $identifier); // Corrected line
                print_r($identifier);
                if(!empty($identifier)) {
                    $mockedShortcodes = new CeresAdapter();
                    $mockedResponse = $mockedShortcodes->getCeresHtml($identifier,$shortcode_data['settings']);
                    echo $mockedResponse;
                }
            } else {
                echo 'No valid shortcode found.';
            }
        }
    }


    public function update($settings) {
        if($settings->generate_shortcode === 'yes') {
            $settings->shortcode = $this->updateShortcode($settings);
        }
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

    public function updateShortcode($settings) {

        $selectedOption = $settings->select_option;
        switch ($selectedOption) {
            case 'drstk_media':
                return $this->generate_drstk_media_shortcode($settings);
            case 'drstk_single':
                return $this->generate_drstk_single_shortcode($settings);
            case 'drstk_slider':
                return $this->generate_drstk_slider_shortcode($settings);
            case 'drstk_title':
                return $this->generate_drstk_title_shortcode($settings);
            case 'drstk_map':
                break;
            case 'drstk_timeline':
                // Add shortcode generation logic for 'drstk_timeline'
                // ...
                break;
        }
        return '';
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

    function generate_drstk_media_shortcode($settings) {
        $shortcode = '[drstk_media';
        $shortcode .= ' id="' . $settings->id . '"';
        $shortcode .= ' height="' . $settings->height . '"';
        $shortcode .= ' width="' . $settings->width . '"';
        $shortcode .= ']';

        return $shortcode;
    }

    function generate_drstk_single_shortcode($settings) {
        $shortcode = '[drstk_single';
        $shortcode .= ' id="' . $settings->id . '"';
        $shortcode .= ' image_size="' . $settings->image_size . '"';
        $shortcode .= ' display_mode="' . $settings->display_mode . '"';
        $shortcode .= ' display_issuu="' . $settings->display_issuu . '"';
        $shortcode .= ' image_alignment="' . $settings->image_alignment . '"';
        $shortcode .= ' caption_align="' . $settings->caption_align . '"';
        $shortcode .= ' caption_position="' . $settings->caption_position . '"';
        $shortcode .= ' zoom_mode="' . $settings->zoom_mode . '"';
        $shortcode .= ' zoom_position="' . $settings->zoom_position . '"';
        $shortcode .= ']';

        return $shortcode;
    }

    function generate_drstk_slider_shortcode($settings) {
        $shortcode = '[drstk_slider';
        $shortcode .= ' id="' . $settings->id . '"';
        $shortcode .= ' image_upload="' . $settings->image_upload . '"';
        $shortcode .= ' image_size="' . $settings->image_size . '"';
        $shortcode .= ' autorotate="' . $settings->autorotate . '"';
        $shortcode .= ' next_prev_buttons="' . $settings->next_prev_buttons . '"';
        $shortcode .= ' dot_pager="' . $settings->dot_pager . '"';
        $shortcode .= ' rotation_speed="' . $settings->rotation_speed . '"';
        $shortcode .= ' max_height="' . $settings->max_height . '"';
        $shortcode .= ']';

        return $shortcode;
    }

    function generate_drstk_title_shortcode($settings) {
        $shortcode = '[drstk_title';
        $shortcode .= ' id="' . $settings->id . '"';
        $shortcode .= ' style_type="' . $settings->style_type . '"';
        $shortcode .= ' text_align="' . $settings->text_align . '"';
        $shortcode .= ' cell_height="' . $settings->cell_height . '"';
        $shortcode .= ' cell_width="' . $settings->cell_width . '"';
        $shortcode .= ' photos="' . $settings->photos . '"';
        $shortcode .= ' lightbox_image_size="' . $settings->lightbox_image_size . '"';
        $shortcode .= ']';

        return $shortcode;
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
                    
                    ),
                    'id' => array(
                        'type'          => 'text',
                        'label'         => __('IDs', 'fl-builder'),
                    ),
                    
                ),
            ),
        ),
    ),
);