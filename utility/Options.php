<?php
namespace Ceres\BeaverBuilder\Utility;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/*
uncomment the top lines (print_r's) to show the results

demonstrates the usage elsewhere
each method corresponds to a set of shortcode options

WP hijacks the direct url if you are going through a browser
but you can just do this in a distinct localhost-accessible file
using whatever path is right for your environment with the require_once


*/

//require_once('/var/www/html/bb-wordpress/wp-content/plugins/CERES-BB-Modules/utility/Options.php');

echo "<h2>Item Options</h2>";
echo "<pre>";
print_r(Options::itemOptions());
echo "</pre>";

echo "<h2>Map Options</h2>";
echo "<pre>";
print_r(Options::mapOptions());
echo "<pre>";

echo "<h2>Tile Gallery Options</h2>";
echo "<pre>";
print_r(Options::tileGalleryOptions());
echo "</pre>";

echo "<h2>Gallery Slider Options</h2>";
echo "<pre>";
print_r(Options::gallerySliderOptions());
echo "</pre>";

echo "<h2>Media Playlist Options</h2>";
echo "<pre>";
print_r(Options::mediaPlaylistOptions());
echo "</pre>";

echo "<h2>Timeline Options</h2>";
echo "<pre>";
print_r(Options::timelineOptions());
echo "</pre>";

/**
 * 
 * Comments after each option indicate the current display,
 * not necessarily what will be used in the future.
 * 
 * Default values for scalars are given, along with the data type
 * Default values for arrays are signalled by a comment inside the array
 *   An array with no default just shows the first key/value pair as usual
 */

class Options {
    public static function itemOptions() {

        $itemOptions = [
            "image-size" => [  // for a select
                1 => "Largest side is 85px",
                2 => "Largest side is 170px",
                3 => "Largest side is 340px",
                4 => "Largest side is 500px",
                5 => "Largest side is 1000px"
            ], 
            "display-video" => true, // bool for an input checkbox
            // display page turner
            "display-issuu" => true, // bool for an input checkbox
            // image flow
            "image-alignment" => [  // for a select
                "left" => "Left",
                "right" => "Right",
            ],
            // caption align
            "caption-align" => [  // for a select
                "center" => "Center",
                "left" => "Left",
                "right" => "Right"
            ],
            "caption-position" => [  // for a select
                "below" => "Below",
                "hover" => "Over Image on Hover"
            ],
            "zoom" => true, // for a single checkbox
            "zoom-position" => [ // for a select
                1 => "Top Right",
                2 => "Middle Right",
                3 => "Bottom Right",
                4 => "Bottom Corner Right",
                5 => "Under Right",
                6 => "Under Middle",
                7 => "Under Left",
                8 => "Bottom Corner Left",
                9 => "Bottom Left",
                10 => "Middle Left",
                11 => "Top Left",
                12 => "Top Corner Left",
                13 => "Above Left",
                14 => "Above Middle",
                15 => "Above Right",
                16 => "Top Right Corner",
                "inner" => "Over image itself",
            ],
        ];
        return $itemOptions;
    }

    public static function mapOptions() {
        $mapOptions = [
            "story" => false, // a boolean currently for a single checkbox
            "metadata" => [ // an array of metadata terms for a collection of checkboxes 
                "full_title_ssi" => true,
                "creator_tesim" => true, 
                "date_ssi" => false,
                "abstract_tesim" => false,
            ],
            "label-color-1" => "#0080ff", // rgb to display in a color picker
        ];

        return $mapOptions;
    }

    public static function tileGalleryOptions() {
        $tileGalleryOptions = [
            "tyle-type" => [ // for a select
                "pinterest-below" => "Pinterest style with caption below",
                "pinterest-hover" => "Pinterest style with caption on hover",
                "even-row" => "Even rows with caption on hover",
                "square" => "Even Squares with caption on hover"
            ],
            "text-align" => [  // for a select
                "center" => "Center",
                "left" => "Left",
                "right" => "Right"
            ],
            "cell-height" => 200, // int in an input type number
            "cell-width" => 200, // int in an input type number
            "image-size" => [ // for a select

            ],
            "metadata" => [ // an array of metadata terms for a collection of checkboxes 
                "full_title_ssi" => true,
                "creator_tesim" => true, 
                "date_ssi" => false,
                "abstract_tesim" => false,
            ],
        ];

        return $tileGalleryOptions;
    }

    public static function gallerySliderOptions() {
        $gallerySliderOptions = [
            "image-size" => [  // for a select
                1 => "Largest side is 85px",
                2 => "Largest side is 170px",
                3 => "Largest side is 340px",
                4 => "Largest side is 500px",
                5 => "Largest side is 1000px"
            ], 
            "autorotate" => true, // bool for a single checkbox
            "next/prev buttons" => false, // bool for a single checkbox
            "dot pager" => true, // bool for a single checkbox
            "rotation speed" => 50, // int in an incrementable input
            "max height" => 100, // int in an incrementable input
        ];

        return $gallerySliderOptions;
    }

    public static function mediaPlaylistOptions() {
        $mediaPlaylistOptions = [
            "height" => "270", // text for a text input
            "width" => "100", //text for a text input
        ];
        
        return $mediaPlaylistOptions;
    }

    public static function timelineOptions() {
        $timelineOptions = [
            "start-date" => 1960, // input type number
            "end-date" => 1990, // input type number
            "metadata" => [ // an array of metadata terms for a collection of checkboxes 
                "full_title_ssi" => true,
                "creator_tesim" => true, 
            ],

            "scale increments" => [  // for a select
                2 => "Low",
                5 => "Medium",
                8 => "High",
                13 => "Very High",
                "0.5" => "Very Low"
            ],
        ];

        return $timelineOptions;
    }
}

