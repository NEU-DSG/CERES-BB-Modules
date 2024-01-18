<?php
namespace Ceres\BeaverBuilder\Utility;

class CeresAdapter {

    /* arrays of valid settings for each module in CERES-BB */
    
    private array $v1ImageCeresOptions = [
        'image_size',
        'display_mode',
        'toggle',
        'help',
        'display_issuu',
        'image_alignment',
        'caption_align',
        'caption_position',
        'zoom_mode',
        'toggle',
        'zoom_position'];
    private array $v1GallerySliderCeresOptions = [
        'image_upload',
        'image_size',
        'autorotate',
        'next_prev_buttons',
        'dot_pager',
        'rotation_speed',
        'max_height',
        'link_field1',
        'editor_field'];
    private array $v1MapCeresOptions = [
        'fields',
        'center_lat',
        'center_long',
        'default_layers',
        'show_title',
        'show_description',
        'show_link'];
    private array $v1TileGalleryCeresOptions = [
        'style_type',
        'text_align',
        'cell_height',
        'cell_width',
        'photos',
        'lightbox_image_size',
        'metadata',
        'link_field1',
        'editor_field'];

    private array $v1TimelineCeresOptions = [
        'start_date_boundary',
        'end_date_boundary',
        'metadata',
        'scale_increments',
        'link_field1',
        'editor_field'];

    private array $v1MediaPlaylistCeresOptions = [
        'height',
        'width',
        'link_field1',
        'editor_field'];

    private array $leafletMapCeresOptions;
    
    /**
     * getCeresHtml
     * 
     * Negotiates between BB and CERES to get the correct HTML
     * from a CERES Renderer or ViewPackage
     *
     * @param string $moduleType
     * @param array $settings
     * @return void
     */
    public function getCeresHtml(string $moduleType, object $settings) {

        switch ($moduleType) {
            case 'v1_single':
                $html = $this->getV1ImageHtml($settings);
                break;

            case 'v1_slider':
                $html = $this->getV1GallerySliderHtml($settings);
                break;

            case 'v1_map':
                $html = $this->getV1MapHtml($settings);
                break;

            case 'v1_tile':
                $html = $this->getV1TileGalleryHtml($settings);
                break;

            case 'v1_timeline':
                $html = $this->getV1TimelineHtml($settings);
                break;

            case 'v1_media':
                $html = $this->getV1MediaPlaylistHtml($settings);
                break;

            case 'leaflet_map':
                $html = $this->getLeafletMapHtml($settings);
                break;
            }

            return $html;
        }

    /* All functions below that use file_get_contents are temporary for dev and testing */

    protected function getV1ImageHtml(array $settings): string {
        print_r("Image module called");
        $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkSingle.html');
        return $html;
    }

    protected function getV1GallerySliderHtml(array $settings): string {
        $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkSlider.html');
        return $html;
    }

    protected function getV1MapHtml(array $settings): string {
        $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkMap.html');
        return $html;
    }

    protected function getV1TileGalleryHtml(array $settings): string {
        $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkTile.html');
        return $html;
    }

    protected function getV1TimelineHtml(array $settings): string {
        $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkTimeline.html');
        return $html;
    }

    protected function getV1MediaPlaylistHtml(array $settings): string {
        $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkMedia.html');
        return $html;
    }

    protected function getLeafletMapHtml(array $settings): string {
        // $html = file_get_contents(CERES_ROOT_DIR . '/data/rendererTemplates/drstkSingle.html');
        //return $html;
    }



    /* Functions to parse the settings */

    protected function parseV1ImageSettings(object $settings): array {

    }


    protected function parseV1GallerySliderSettings(object $settings): array {
        
    }


    protected function parseV1MapSettings(object $settings): array {
        
    }


    protected function parseV1TileGallerySettings(object $settings): array {
        
    }


    protected function parseV1TimelineSettings(object $settings): array {
        
    }


    protected function parseV1MediaPlaylistSettings(object $settings): array {
        
    }


    protected function parseV1LeafletMapSettings(object $settings): array {
        
    }




}