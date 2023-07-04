<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;

class ArrayTable extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES ArrayTable BB module', 'fl-builder' ),
            'description'     => __( 'Just Testing', 'fl-builder' ),
            'group'           => __( 'CERES Classic', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_table',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_table',
            'icon'            => 'button.svg',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
    }

    public function test() {
        $settings = $this->settings;
        $selectedOption = isset($settings->select_option) ? $settings->select_option : 'Small';

        $table = '<table>';
        $table .= '<tr><th>Size</th><th>Dimensions</th></tr>';

        if ($selectedOption === 'All') {
            $smallValue = isset($settings->Small) ? $settings->Small : '10x10';
            $mediumValue = isset($settings->Medium) ? $settings->Medium : '100x100';
            $largeValue = isset($settings->Large) ? $settings->Large : '1000x1000';

            $table .= '<tr>';
            $table .= '<td>Small</td>';
            $table .= '<td>' . $smallValue . '</td>';
            $table .= '</tr>';

            $table .= '<tr>';
            $table .= '<td>Medium</td>';
            $table .= '<td>' . $mediumValue . '</td>';
            $table .= '</tr>';

            $table .= '<tr>';
            $table .= '<td>Large</td>';
            $table .= '<td>' . $largeValue . '</td>';
            $table .= '</tr>';
        } else if ($selectedOption === 'Small' || $selectedOption === 'Medium' || $selectedOption === 'Large') {
            $value = isset($settings->{$selectedOption}) ? $settings->{$selectedOption} : '';

            $table .= '<tr>';
            $table .= '<td>' . ucfirst($selectedOption) . '</td>';
            $table .= '<td>' . $value . '</td>';
            $table .= '</tr>';
        }

        $table .= '</table>';

        return $table;
    }
}

// Use expanded classname to register the module
FLBuilder::register_module('Ceres\BeaverBuilder\Module\ArrayTable', array(
    'general' => array(
        'title'    => __('General', 'fl-builder'),
        'sections' => array(
            'config' => array(
                'title'  => __('Table Configuration', 'fl-builder'),
                'fields' => array(
                    'select_option'     => array(
                        'type'          => 'select',
                        'label'         => __('Dimensions', 'fl-builder'),
                        'default'       => 'Small',
                        'options'       => array(
                            'Small'      => __('Small', 'fl-builder'),
                            'Medium'      => __('Medium', 'fl-builder'),
                            'Large'      => __('Large', 'fl-builder'),
                            'All'      => __('All', 'fl-builder'),
                        ),
                        'toggle'        => array(
                            'Small'      => array(
                                'fields'        => array('Small'),
                            ),
                            'Medium'      => array(
                                'fields'        => array('Medium'),
                            ),
                            'Large'      => array(
                                'fields'        => array('Large'),
                            ),
                            'All'  => array(
                                'fields' => array('Small', 'Medium', 'Large')
                            )
                        )
                    ),
                    'Small'   => array(
                        'type'          => 'text',
                        'label'         => __('Small Value', 'fl-builder'),
                        'default'       => '10x10',
                    ),
                    'Medium'   => array(
                        'type'          => 'text',
                        'label'         => __('Medium Value', 'fl-builder'),
                        'default'       => '100x100'
                    ),
                    'Large'   => array(
                        'type'          => 'text',
                        'label'         => __('Large Value', 'fl-builder'),
                        'default'       => '1000x1000',
                    )
                )
            ),
        ),
    ),
));
