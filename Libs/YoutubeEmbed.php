<?php

namespace WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs;

defined('ABSPATH') or die();

class YoutubeEmbed implements Interfaces\GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        add_filter('embed_oembed_html', [$this, 'youtubeNoCookieEmbed'], 10, 4);
    }

    public function youtubeNoCookieEmbed($html, $url, $attr, $post_ID): string {
        $returnValue = $html;

        if (preg_match('#https?://(www\.)?youtu#i', $url)) {
            $returnValue = preg_replace(
                '#src=(["\'])(https?:)?//(www\.)?youtube\.com#i',
                'src=$1$2//$3youtube-nocookie.com',
                $html
            );
        }

        return $returnValue;
    }
}
