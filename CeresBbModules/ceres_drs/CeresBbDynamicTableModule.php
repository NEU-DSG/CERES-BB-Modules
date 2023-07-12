<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;
use function Clue\StreamFilter\append;

class DynamicTable extends FLBuilderModule
{
    public function __construct()
    {
        parent::__construct(array(
            'name'            => __('CERES DynamicTable BB module', 'fl-builder'),
            'description'     => __('Just Testing', 'fl-builder'),
            'group'           => __('CERES Classic', 'fl-builder'),
            'category'        => __('CERES', 'fl-builder'),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_drs',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_drs',
            'icon'            => 'button.svg',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
    }

    public function test()
    {
        $settings = $this->settings;
        $selectedOption = isset($settings->select_option) ? $settings->select_option : '';

        $table = '<table>';
        $table .= '<tr><th>Key</th><th>Value</th></tr>';

        if ($selectedOption === 'All') {
            $keyValues = $this->getKeyValues();

            foreach ($keyValues as $key => $value) {
                $table .= '<tr>';
                $table .= '<td>' . $key . '</td>';
                $table .= '<td>' . $value . '</td>';
                $table .= '</tr>';
            }
        } else if ($selectedOption) {
            $keyValues = $this->getKeyValues();

            if (isset($keyValues[$selectedOption])) {
                $value = $keyValues[$selectedOption];

                $table .= '<tr>';
                $table .= '<td>' . $selectedOption . '</td>';
                $table .= '<td>' . $value . '</td>';
                $table .= '</tr>';
            }
        }

        $table .= '</table>';

        return $table;
    }

    public function getKeyValues()
    {
        $keyValues = $this->getKeyValueMap();
        return $keyValues;
    }

    public function getKeyValueMap()
    {
        $keyValueMap = array(
            'Key 1' => 'Value 1',
            'Key 2' => 'Value 2',
            'Key 3' => 'Value 3',
            'Key 4' => 'Value 4',
        );
        return $keyValueMap;
    }
}

FLBuilder::register_module('Ceres\BeaverBuilder\Module\DynamicTable', array(
    'general' => array(
        'title'    => __('General', 'fl-builder'),
        'sections' => array(
            'config' => array(
                'title'  => __('Table Configuration', 'fl-builder'),
                'fields' => array(
                    'select_option'     => array(
                        'type'          => 'select',
                        'label'         => __('Dimensions', 'fl-builder'),
                        'default'       => 'Key 1',
                        'options'       => getKeyValueOptions(),
//                        'toggle'        => getToggleValues()
                    ),
//                    getDefaults(),
                )
            ),
        ),
    ),
));


// Define the callback function to register dynamic fields
function registerDynamicFields($module)
{
    $keyValues = $module->getKeyValues();

    // Register the default_value field
    $module->add_field(
        'default_value',
        __('Default Value', 'fl-builder'),
        'text',
        array(
            'default' => '',
        )
    );

    foreach ($keyValues as $key => $value) {
        $module->add_field(
            $key,
            __($key, 'fl-builder') . ' Value',
            'text',
            array(
                'default' => $value,
                'toggle'  => array(
                    'default' => array(
                        'fields' => array('default_value'),
                    ),
                    'callback' => 'getToggleValues',
                ),
            )
        );
    }
}

function getKeyValueOptions()
{
    $module = new DynamicTable();
    $keyValues = $module->getKeyValues();

    $options = array();
    foreach ($keyValues as $key => $value) {
        $options[$key] = __($key, 'fl-builder');
    }
    $options['All'] = __('All', 'fl-builder');
    return $options;
}

function getToggleValues()
{
    $module = new DynamicTable();
    $keyValues = $module->getKeyValues();

    $fields = array();
    foreach ($keyValues as $key => $value) {
        $fields[$key] = array('fields' => array($key));
    }
    $fields['All'] = array('fields' => array_keys($keyValues));

    return $fields;
}

function getDefaults()
{
    $module = new DynamicTable();
    $keyValues = $module->getKeyValues();

    $options = array();
    foreach ($keyValues as $key => $value) {
        $options[$key] = array($key => array(
            'type'          => 'text',
            'label'         => __($key, 'fl-builder'),
            'default'       => $value,
        ));
    }
    $options['All'] = array('fields' => array_keys($keyValues));

    return $options;
}
