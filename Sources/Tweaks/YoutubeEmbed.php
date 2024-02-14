<?php

/**
 * Change the YouTube embed to use the no-cookie domain
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Change the YouTube embed to use the no-cookie domain
 */
class YoutubeEmbed implements GenericInterface {
    /**
     * Constructor
     */
    public function __construct() {
        $this->execute();
    }

    /**
     * Execute the filters and so on
     */
    public function execute(): void {
        add_filter(
            hook_name: 'embed_oembed_html',
            callback: [$this, 'youtubeNoCookieEmbed'],
            priority: 10,
            accepted_args: 4
        );
    }

    /**
     * Change the YouTube embed to use the no-cookie domain
     *
     * @param string $html
     * @param string $url
     * @param array $attr
     * @param int $post_ID
     *
     * @return string
     */
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
