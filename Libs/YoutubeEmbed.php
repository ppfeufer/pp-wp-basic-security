<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

defined(constant_name: 'ABSPATH') or die();

class YoutubeEmbed implements Interfaces\GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        add_filter(
            hook_name: 'embed_oembed_html',
            callback: [$this, 'youtubeNoCookieEmbed'],
            priority: 10,
            accepted_args: 4
        );
    }

    public function youtubeNoCookieEmbed($html, $url, $attr, $post_ID): string {
        $returnValue = $html;

        if (preg_match(pattern: '#https?://(www\.)?youtu#i', subject: $url)) {
            $returnValue = preg_replace(
                pattern: '#src=(["\'])(https?:)?//(www\.)?youtube\.com#i',
                replacement: 'src=$1$2//$3youtube-nocookie.com',
                subject: $html
            );
        }

        return $returnValue;
    }
}
