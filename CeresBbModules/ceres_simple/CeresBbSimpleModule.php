<?php
// namespacing this into CERES, not the weak file name approach BB recommends
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;


error_reporting(E_ALL);

class Simple extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'        => __('CERES Simple BB module', 'fl-builder'),
            'description' => __('A custom module that takes input text from the user and displays it.', 'fl-builder'),
            'group'       => __( 'CERES Classic', 'fl-builder' ),
            'category'    => __('CERES', 'fl-builder'),
            'dir'         => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_simple',
            'url'         => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_simple',
            'editor_export' => true,
            'enabled'     => true,
        ));
    }

    public function test() {
        return "
        <h1>Welcome to my website</h1>
        <p>This is a simple example of hardcoded HTML within a BB module.</p>
        <ul>
        <li>This is issue#1</li>
        <li>Soon will be working on issue#2</li>
        </ul>
        ";
    }

    public function render() {
        $this->settings->user_input = htmlspecialchars($_POST['user_input']);
        $user_input = $this->settings->user_input;
        echo '<script>console.log("Render triggered: "'.$user_input.')</script>';
        echo '<h4>' . $user_input . '</h4>';
        echo '<hr>';
    }
}

//use expanded classname to register the module
FLBuilder::register_module( 'Ceres\BeaverBuilder\Module\Simple', array(
    'my-tab-1'      => array(
        'title'     => __( 'Tab 2', 'fl-builder' ),
        'sections'  => array(
            'general' => array(
                'title' => __( 'Section 1', 'fl-builder' ),
                'fields' => array(
                    'user_input' => array(
                        'type'        => 'text',
                        'label'       => 'User Input',
                        'placeholder' => 'Enter your text here',
                    ),
                    'user_table' => array(
                        'small' => '10x10',
                        'medium' => '100x100',
                        'large' => '1000x1000',
                    ),
                ),
            ),
        ),
    ),
) );
