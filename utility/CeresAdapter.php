<?php
namespace Ceres\BeaverBuilder\Utility;

class CeresAdapter {


    private array $v1ImageCeresOptions;
    private array $v1GallerySliderCeresOptions;
    private array $v1MapCeresOptions;
    private array $v1TileGalleryCeresOptions;
    private array $v1TimelineCeresOptions;
    private array $v1MediaPlaylistCeresOptions;
    private array $v1LeafletMapCeresOptions;
    
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
            case 'v1_image':
                $html = $this->getV1ImageHtml($settings);
                break;

            case 'v1_gallerySlider':
                $html = $this->getV1GallerySliderHtml($settings);
                break;

            case 'v1_map':
                $html = $this->getV1MapHtml($settings);
                break;

            case 'v1_tileGallery':
                $html = $this->getV1TileGalleryHtml($settings);
                break;

            case 'v1_timeline':
                $html = $this->getV1TimelineHtml($settings);
                break;

            case 'v1_mediaPlaylist':
                $html = $this->getV1MediaPlaylistHtml($settings);
                break;

            case 'leafletMap':
                $html = $this->getLeafletMapHtml($settings);
                break;
            }

            return $html;
        }

    /* All functions below that use file_get_contents are temporary for dev and testing */

    protected function getV1ImageHtml(array $settings): string {
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