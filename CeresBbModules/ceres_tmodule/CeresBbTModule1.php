<?php
namespace Ceres\BeaverBuilder\Module;

use FLBuilderModule;
use FLBuilder;

class TModule extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'CERES Test1 BB module', 'fl-builder' ),
            'description'     => __( 'Just Testing', 'fl-builder' ),
            'group'           => __( 'CERES Classic', 'fl-builder' ),
            'category'        => __( 'CERES', 'fl-builder' ),
            'dir'             => CERES_BB_MODULES_DIR . 'CeresBbModules/ceres_tmodule',
            'url'             => CERES_BB_MODULES_URL . 'CeresBbModules/ceres_tmodule',
            'icon'            => 'button.svg',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));

        // Already registered
        $this->add_css('font-awesome');
        $this->add_js('jquery-bxslider');
    }

    public function update($settings){
        $settings->textarea_field = $this->settings->textarea_field;
        return $settings;
    }

    public function render()
    {
        $settings = $this->settings;
        $module_id = $this->node;
        $textarea_field = $settings->textarea_field;
        if (isset($_POST['button2_' . $module_id])) {
            $textarea_field = htmlspecialchars($_POST['textarea_field_' . $module_id]);
            $this->settings->textarea_field = $textarea_field;
        }
        include $this->dir . '/includes/input-form.php';
    }

}

// Register the module
FLBuilder::register_module('Ceres\BeaverBuilder\Module\TModule', array(
    'my-tab-1' => array(
        'title'    => __( 'Tab 1', 'fl-builder' ),
        'sections' => array(
            'my-section-1' => array(
                'title'  => __( 'Section 1', 'fl-builder' ),
                'fields' => array(
                    'textarea_field' => array(
                        'type'        => 'textarea',
                        'label'       => __( 'Textarea Field', 'fl-builder' ),
                        'default'     => '',
                        'placeholder' => __( 'Placeholder Text', 'fl-builder' ),
                        'rows'        => '6',
                        'preview'     => array(
                            'type'     => 'text',
                            'selector' => '.fl-example-text'
                        )
                    )
                )
            )
        )
    )
));
?>