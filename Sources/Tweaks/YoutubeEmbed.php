<?php

/**
 * Change the YouTube embed to use the no-cookie domain
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Change the YouTube embed to use the no-cookie domain
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 * @access public
 */
class YoutubeEmbed implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        $this->execute();
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @since 1.0.0
     * @access public
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
     * @param string $html The html of the embed
     * @param string $url The url of the embed
     * @param array $attr The attributes of the embed
     * @param int $post_ID The post id
     *
     * @return string
     * @since 1.0.0
     * @access public
     */
    public function youtubeNoCookieEmbed(
        string $html,
        string $url,
        array $attr,
        int $post_ID
    ): string {
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
