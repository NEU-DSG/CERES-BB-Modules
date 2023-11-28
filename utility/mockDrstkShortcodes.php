<?php
namespace Ceres\BeaverBuilder\Utility;

use DOMDocument;

function getMockShortcodeResponse($shortcodeType) {

    $dom = new DOMDocument();
    switch ($shortcodeType) {
        case 'single':
            $dom->loadHTMLFile(CERES_ROOT_DIR . '/data/rendererTemplates/drstkSingle.html');
            break;

        case 'tile':
            $dom->loadHTMLFile(CERES_ROOT_DIR . '/data/rendererTemplates/drstkTile.html');
            break;

        case 'map':
            $dom->loadHTMLFile(CERES_ROOT_DIR . '/data/rendererTemplates/drstkMap.html');
            break;

        case 'media':
            $dom->loadHTMLFile(CERES_ROOT_DIR . '/data/rendererTemplates/drstkMedia.html');
            break;

        case 'timeline':
            $dom->loadHTMLFile(CERES_ROOT_DIR . '/data/rendererTemplates/drstkTimeline.html');
            break;

        case 'slider':
            $dom->loadHTMLFile(CERES_ROOT_DIR . '/data/rendererTemplates/drstkSlider.html');
            break;

        default:
            echo "Invalid shortcode type. Valid types are: single, tile, map, media, timeline, slider.";
            die();
    }

    $containerNode = $dom->getElementById('ceres-container');
    return $dom->saveHTML($containerNode);
}
