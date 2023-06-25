<?php

/* Only useful for a particular pre-full integration development step
 * Will be deleted eventually
 */

 echo "hello";


/* Direct based on GET params */

switch ($_GET['type']) {
    //yes I know $_GET is global, but I hate globals so I'm not going to pretend we're friends
    case 'html':
        modifyHtml($_GET);
    break;

    case 'list':
        modifyList($_GET);
    break;

    case 'map':
        modifyMap($_GET);
    break;

    case 'storymap':
        modifyStoryMap($_GET);
    break;


}

function modifyHtml(array $params): string {
    $htmlSpanReplaceHtml = "<span id='ceres-test-replace'>I need to go away</span>";
    $htmlH2ReplaceHtml = "Hello! I'll be replaced someday!";

    if (isset($params['html'])) {
        $htmlH2ReplaceHtml = $params['h2'];
    }

    if (isset($params['span'])) {
        $htmlSpanReplaceHtml = $params['span'];
    }

    $html = "<div id='ceres-container'>";
    $html .= "<h2>";
    $html .= $htmlH2ReplaceHtml;
    $html .= "</h2>";

    $html .= "<p>";
    $html .= $htmlSpanReplaceHtml;
    $html .= "</p>";

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

