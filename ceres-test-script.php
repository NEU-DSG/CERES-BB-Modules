<?php

/* Only useful for a particular pre-full integration development step
 * Will be deleted eventually
 */



/* Direct based on GET params */

switch ($_GET['type']) {
    //yes I know $_GET is global, but I hate globals so I'm not going to pretend we're friends
    case 'html':
        $html = modifyHtml($_GET);
    break;

    case 'list':
        $html = modifyList($_GET);
    break;

    case 'map':
        $html = modifyMap($_GET);
    break;

    case 'storymap':
        $html = modifyStoryMap($_GET);
    break;

    case 'table':
        $html = modifyTable($GET);
    break;



    default:
        $html = "whoopsie. not a valid type param. at least not yet.";
    break;
}

echo $html;

function modifyHtml(array $params): string {
    $spanReplaceHtml = "<span id='ceres-test-replace'>I need to go away</span>";
    $h2ReplaceHtml = "Hello! I'll be replaced someday!";

    if (isset($params['h2'])) {
        $h2ReplaceHtml = $params['h2'];
    }

    if (isset($params['span'])) {
        $spanReplaceHtml = $params['span'];
    }

    if (isset($params['something'])) {
        $somethingReplaceHtml = "whatevs";
    }

    $html = "<div id='ceres-container'>";
    $html .= "<h2>";
    $html .= $h2ReplaceHtml;
    $html .= "</h2>";

    $html .= "<p>";
    $html .= $spanReplaceHtml;
    $html .= "</p>";

    $html .= "</div>";
    return $html;
}

function modifyTable(array $params): string {
    $html = "<div id='ceres-container'>";

    $html .= "</div>";
    return $html;
}


function modifyList(array $params): string {
    $html = "<div id='ceres-container'>";

    $html .= "</div>";
    return $html;
}

function modifyMap(array $params): string {
    $html = "<div id='ceres-container'>";

    $html .= "</div>";
    return $html;
}


function modifyStoryMap(array $params): string {
    $html = "<div id='ceres-container'>";

    $html .= "</div>";
    return $html;
}

