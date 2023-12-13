<?php
namespace Ceres\BeaverBuilder\Module;
use Ceres\BeaverBuilder\Utility\Options;

require_once __DIR__ . '/../../utility/Options.php';
use FLBuilderModule;
use FLBuilder;

class TimelineModule extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Timeline module', 'fl-builder' ),
            'description'     => __( 'Custom Timeline Module', 'fl-builder' ),
            'group'           => __( 'CERES Legacy', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_timeline',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_timeline',
            'icon'            => 'button.svg',
            'editor_export'   => true,
            'enabled'         => true,
            'partial_refresh' => false,
        ));

    }

}

FLBuilder::register_module('Ceres\BeaverBuilder\Module\TimelineModule', array(
    'general' => array(
        'title'    => __('General', 'fl-builder'),
        'sections' => array(
            'section_1' => array(
                'title'  => __('Date Boundaries', 'fl-builder'),
                'fields' => array(
                    'start_date_boundary' => array(
                        'type'  => 'date',
                        'label' => __('Start Date Boundary', 'fl-builder'),
                    ),
                    'end_date_boundary'   => array(
                        'type'  => 'date',
                        'label' => __('End Date Boundary', 'fl-builder'),
                    ),
                ),
            ),
            'section_2' => array(
                'title'  => __('Metadata', 'fl-builder'),
                'fields' => array(
                    'metadata' => array(
                        'type'    => 'checkboxes',
                        'label'   => __('Metadata', 'fl-builder'),
                        'options' => array(
                            'option_1' => __('Option 1', 'fl-builder'),
                            'option_2' => __('Option 2', 'fl-builder'),
                            'option_3' => __('Option 3', 'fl-builder'),
                        ),
                    ),
                ),
            ),
            'section_3' => array(
                'title'  => __('Scale Increments', 'fl-builder'),
                'fields' => array(
                    'scale_increments' => array(
                        'type'    => 'select',
                        'label'   => __('Scale Increments', 'fl-builder'),
                        'default' => '1',
                        'options' => array(
                            '1'   => __('1', 'fl-builder'),
                            '2'   => __('2', 'fl-builder'),
                            '5'   => __('5', 'fl-builder'),
                            '10'  => __('10', 'fl-builder'),
                        ),
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
));