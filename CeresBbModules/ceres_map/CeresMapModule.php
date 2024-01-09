<?php
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;
class MapModule extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __('CERES Map Module', 'fl-builder'),
            'description'     => __('Custom module for maps', 'fl-builder'),
            'group'           => __('CERES v1', 'fl-builder'),
            'category'        => __('CERES', 'fl-builder'),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_map',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_map',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

    }

    public function render()
    {
        $default_zoom = $this->settings->default_zoom;
        $center_lat = $this->settings->center_lat;
        $center_long = $this->settings->center_long;
        $default_layers = $this->settings->default_layers;
        $show_title = $this->settings->show_title;
        $show_description = $this->settings->show_description;
        $show_link = $this->settings->show_link;

        echo '<div class="custom-map" data-default-zoom="' . $default_zoom . '" data-center-lat="' . $center_lat . '" data-center-long="' . $center_long . '" data-default-layers="' . $default_layers . '" data-show-title="' . $show_title . '" data-show-description="' . $show_description . '" data-show-link="' . $show_link . '">';
        echo 'Map content goes here';
        echo '</div>';
    }
}

FLBuilder::register_module('Ceres\BeaverBuilder\Module\MapModule', array(
    'general' => array(
        'title'    => __('General', 'fl-builder'),
        'sections' => array(
            'section_1' => array(
                'title'  => __('Map Settings', 'fl-builder'),
                'fields' => array(
                    'default_zoom' => array(
                        'type'  => 'text',
                        'label' => __('Default Zoom Level', 'fl-builder'),
                    ),
                    'center_lat'   => array(
                        'type'  => 'text',
                        'label' => __('Starting Latitude at Center', 'fl-builder'),
                    ),
                    'center_long'  => array(
                        'type'  => 'text',
                        'label' => __('Starting Longitude at Center', 'fl-builder'),
                    ),
                    'default_layers' => array(
                        'type'    => 'text',
                        'label'   => __('Default Layer(s) Visible at Load', 'fl-builder'),
                    ),
                ),
            ),
            'section_2' => array(
                'title'  => __('Display Options', 'fl-builder'),
                'fields' => array(
                    'show_title'       => array(
                        'type'    => 'select',
                        'label'   => __('Show Title', 'fl-builder'),
                        'default' => 'yes',
                        'options' => array(
                            'yes' => __('Yes', 'fl-builder'),
                            'no'  => __('No', 'fl-builder'),
                        ),
                    ),
                    'show_description' => array(
                        'type'    => 'select',
                        'label'   => __('Show Description', 'fl-builder'),
                        'default' => 'yes',
                        'options' => array(
                            'yes' => __('Yes', 'fl-builder'),
                            'no'  => __('No', 'fl-builder'),
                        ),
                    ),
                    'show_link'        => array(
                        'type'    => 'select',
                        'label'   => __('Show Link to More Information', 'fl-builder'),
                        'default' => 'yes',
                        'options' => array(
                            'yes' => __('Yes', 'fl-builder'),
                            'no'  => __('No', 'fl-builder'),
                        ),
                    ),
                ),
            ),
        ),
    ),
));
