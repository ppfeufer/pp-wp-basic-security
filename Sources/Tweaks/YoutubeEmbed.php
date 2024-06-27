<?php

/**
 * Change the YouTube embed to use the no-cookie domain
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Change the YouTube embed to use the no-cookie domain
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @access public
 */
class YoutubeEmbed extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_youtube_embed')) {
            $this->execute();
        }
    }

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array {
        return [
            'id' => 'tweak_youtube_embed',
            'title' => __('YouTube Embed (no cookie)', 'pp-wp-basic-security'),
            'desc' => __('Change the YouTube embed to use the no-cookie domain', 'pp-wp-basic-security'),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Execute the filters and so on
     *
     * @return void
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
