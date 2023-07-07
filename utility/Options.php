<?php
namespace Ceres\BeaverBuilder\Utility;

/**
 * 
 * Comments after each option indicate the current display,
 * not necessarily what will be used in the future.
 * 
 * Default values for arrays are signalled by a comment inside the array
 */

class Options {
    public static function itemOptions() {
        $itemOptions = [
            "image size" => [], // for a select
            "display page turner" => false, // for a single checkbox
            "image alignment" => [], // for a select
            "image flow" => [], // for a selece
            "caption alignment" => [], // for a select
            "caption position" => [], // for a select
        ];
        return $itemOptions;
    }

    public static function mapOptions() {
        $mapOptions = [
            "story" => false, // a boolean currently for a single checkbox
            "metadata" => [], // an array of metadata terms for a collection of checkboxes
            "color settings" => "", // rgb to display in a color picker
        ];

        return $mapOptions;
    }

    public static function tileGalleryOptions() {
        $tileGalleryOptions = [
            "layout type" => [], // for a select
            "caption alignment" => [], // for a select
            "cell height" => 1, // int in an incrementable input
            "cell width" => 1, // int in an incrementable input
            "image size" => [], // for a select
            "metadata for captions" => [], // an array of metadata terms for a collection of checkboxes
        ];

        return $tileGalleryOptions;
    }

    public static function gallerySliderOptions() {
        $gallerySliderOptions = [
            "image size" => [], // for a select
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
            "height" => "", // text for a text input
            "width" => "", //text for a text input
        ];
        
        return $mediaPlaylistOptions;
    }

    public static function timelineOptions() {
        $timelineOptions = [
            "start date boundary" => "", // ??
            "end date boundary" => "", // ??
            "metadata" => [], // array of metadata terms for a collection of checkboxes
            "scale increments" => [], // for a select
        ];

        return $timelineOptions;
    }
}

