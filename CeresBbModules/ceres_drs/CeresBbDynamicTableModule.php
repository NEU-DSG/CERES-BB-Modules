<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;

class DynamicTable extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES DynamicTable BB module', 'fl-builder' ),
            'description'     => __( 'Just Testing', 'fl-builder' ),
            'group'           => __( 'CERES v1', 'fl-builder' ),
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
        $selectedOption = isset($settings->select_option) ? $settings->select_option : '';

        $table = '<table>';
        $table .= '<tr><th>Key</th><th>Value</th></tr>';

        if ($selectedOption === 'All') {
            if (isset($settings->key_value_map) && is_array($settings->key_value_map)) {
                foreach ($settings->key_value_map as $item) {
                    if (isset($item->key) && isset($item->value)) {
                        $table .= '<tr>';
                        $table .= '<td>' . $item->key . '</td>';
                        $table .= '<td>' . $item->value . '</td>';
                        $table .= '</tr>';
                    }
                }
            }
        }

        $table .= '</table>';

        return $table;
    }
}

FLBuilder::register_module('Ceres\BeaverBuilder\Module\DynamicTable', array(
    'general' => array(
        'title'    => __('General', 'fl-builder'),
        'sections' => array(
            'config' => array(
                'title'  => __('Table Configuration', 'fl-builder'),
                'fields' => array(
                    'select_option' => array(
                        'type'          => 'select',
                        'label'         => __('Dimensions', 'fl-builder'),
                        'default'       => '',
                        'options'       => array(
                            ''         => __('Select an option', 'fl-builder'),
                            'All'      => __('All', 'fl-builder'),
                        ),
                        'toggle'        => array(
                            'All'  => array(
                                'fields' => array('key_value_map')
                            )
                        )
                    ),
                    'key_value_map' => array(
                        'type'          => 'form',
                        'label'         => __('Key-Value Map', 'fl-builder'),
                        'form'          => 'key_value_map_form',
                        'preview_text'  => 'key',
                        'multiple'      => true,
                        'settings'      => array(
                            'form_title' => __('Key-Value Pair', 'fl-builder'),
                            'form_fields' => array(
                                'key'   => array(
                                    'type'          => 'text',
                                    'label'         => __('Key', 'fl-builder'),
                                ),
                                'value' => array(
                                    'type'          => 'text',
                                    'label'         => __('Value', 'fl-builder'),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
));

FLBuilder::register_settings_form('key_value_map_form', array(
    'title' => __('Key-Value Map', 'fl-builder'),
    'tabs'  => array(
        'general' => array(
            'title'    => __('General', 'fl-builder'),
            'sections' => array(
                'config' => array(
                    'title'  => __('Configuration', 'fl-builder'),
                    'fields' => array(
                        'key'   => array(
                            'type'          => 'text',
                            'label'         => __('Key', 'fl-builder'),
                        ),
                        'value' => array(
                            'type'          => 'text',
                            'label'         => __('Value', 'fl-builder'),
                        ),
                    ),
                ),
            ),
        ),
    ),
));
