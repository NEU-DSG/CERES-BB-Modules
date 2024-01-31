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

        wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.0.0-rc.2/dist/leaflet.css');
        wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.0.0-rc.2/dist/leaflet.js', array(), null, true);


        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css');
        wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.1.0.min.js', array(), '3.1.0', true);

        wp_enqueue_script('wkt', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/brc/wicket-1.3.8.js', array(), null, true);
        wp_enqueue_script('bostonboundaries', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/brc/bostonboundaries.js', array(), null, true);
        wp_enqueue_script('leaflet-boundary-canvas', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/brc/leaflet-boundary-canvas.js', array(), null, true);
        wp_enqueue_script('leaflet-markercluster', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/leaflet-js-markercluster/leaflet.markercluster.js', array(), null, true);
        wp_enqueue_script('markerClusterGroup', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/leaflet-js-markercluster/leaflet.markercluster-src.js', array(), null, true);
        wp_enqueue_script('fuse-leaflet-plugin-6-6-2', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/fuse-leaflet-plugin-6-6-2.js', array(), null, true);
        wp_enqueue_script('leaflet-plugin-mask', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/leafet-plugin-mask.js', array(), null, true);
        wp_enqueue_script('L', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/leaflet1.7.1.js', array(), null, true);
        wp_enqueue_script('leaflet-plugin-geolet2', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/leaflet-plugin-geolet.js', array(), null, true);
        wp_enqueue_script('leaflet-plugin-locate', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/js/leaflet/leaflet-plugin-locate.js', array(), null, true);

        wp_enqueue_script('leaflet-core-js', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/leaflet-brc-project.js', array(), null, true);

        wp_enqueue_style('leaflet-brc-project-css', CERES_BB_MODULES_URL . 'Leaflet-core/assets/css/leaflet/brc/leaflet-brc-project.css', array('leaflet-js'), null, true);
        wp_enqueue_style('leaflet-brc-project-storymap', CERES_BB_MODULES_URL . 'Leaflet-core/assets/css/leaflet/brc/leaflet-brc-project-storymap.css', array('leaflet-js'), null, true);
        wp_enqueue_style('leaflet-brc-project', CERES_BB_MODULES_URL . 'Leaflet-core/assets/css/leaflet/brc/leaflet-brc-project.css');

        // LEAFLET JS
        wp_enqueue_script('config-js', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/config.js', array(), null, true);
        wp_enqueue_script('common-js', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/common.js', array(), null, true);
        wp_enqueue_script('boston-boundary', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/bostonboundaries.js', array(), null, true);
        wp_enqueue_script('leafet-plugin-mask', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/leafet-plugin-mask.js', array(), null, true);
        wp_enqueue_script('leaflet-boundary-canvas', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/leaflet-boundary-canvas.js', array(), null, true);
        wp_enqueue_script('leaflet-brc-project-storymap', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/leaflet-brc-project-storymap.js', array(), null, true);
        wp_enqueue_script('leaflet-plugin-geolet', CERES_BB_MODULES_URL . 'Leaflet-core/assets/js/leaflet/brc/leaflet-plugin-geolet.js', array(), null, true);

        // LEAFLET CSS
        wp_enqueue_style('leaflet-brc-project', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/css/leaflet/brc/leaflet-brc-project.css');
        wp_enqueue_style('MarkerCluster', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/css/leaflet/leaflet-js-markercluster/MarkerCluster.css');
        wp_enqueue_style('MarkerCluster-Default', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/css/leaflet/leaflet-js-markercluster/MarkerCluster.Default.css');
        wp_enqueue_style('leaflet', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/css/leaflet/leaflet.css');
        wp_enqueue_style('leaflet-brc-project', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/css/leaflet/leaflet-brc-project.css');
        wp_enqueue_style('leaflet-js-locate-plugin', CERES_BB_MODULES_URL . '../drs-toolkit-wp-plugin/libraries/Ceres/assets/css/leaflet/leaflet-js-locate-plugin.css');

        wp_localize_script('leaflet-core-js', 'leaflet_core_data', array(
            'image_url_1' => CERES_BB_MODULES_URL . 'Leaflet-core/assets/images/brc/external-link.svg',
            'image_url_2' => CERES_BB_MODULES_URL . 'Leaflet-core/assets/images/brc/marker-icon-2x-blue.png',
            'image_url_3' => CERES_BB_MODULES_URL . 'Leaflet-core/assets/images/brc/marker-icon-2x-red.png',
            'image_url_4' => CERES_BB_MODULES_URL . 'Leaflet-core/assets/images/brc/marker-shadow.png',
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
        echo '<div id="map" style="height: 400px;"></div>';
        include CERES_BB_MODULES_DIR . '../../Leaflet-core/brc-leaflet.html';
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
