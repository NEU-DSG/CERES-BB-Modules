<?php
namespace Ceres\BeaverBuilder\Utility;

use DOMDocument;
class mockDrstkShortcodes
{
    function getMockShortcodeResponse($shortcodeType)
    {
        $dom = new DOMDocument();
        switch ($shortcodeType) {
            case 'single':
                $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkSingle.html');
                break;

            case 'tile':
                $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkTile.html');
                break;

            case 'map':
                $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkMap.html');
                break;

            case 'media':
                $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkMedia.html');
                break;

            case 'timeline':
                $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkTimeline.html');
                break;

            case 'slider':
                $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkSlider.html');
                break;

            default:
                echo "Invalid shortcode type. Valid types are: single, tile, map, media, timeline, slider.";
                die();
        }

        $containerNode = $dom->getElementById('ceres-container');
        return $dom->saveHTML($containerNode);
    }
}
