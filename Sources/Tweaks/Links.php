<?php

/**
 * Remove some link definitions link from head
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove some link definitions link from `<head>`
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 */
class Links implements GenericInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_links')) {
            $this->execute();
        }
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function execute(): void {
        /**
         * Removing `<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />`
         *
         * @see https://developer.wordpress.org/reference/functions/rsd_link/
         */
        remove_action(hook_name: 'wp_head', callback: 'rsd_link');

        /**
         * Removing relational next/prev links
         *
         * @see https://developer.wordpress.org/reference/functions/adjacent_posts_rel_link/
         */
        remove_action(
            hook_name: 'wp_head',
            callback: 'adjacent_posts_rel_link',
            priority: 10
        );
        remove_action(
            hook_name: 'wp_head',
            callback: 'adjacent_posts_rel_link_wp_head',
            priority: 10
        );

        /**
         * Removing short link
         *
         * @see https://developer.wordpress.org/reference/functions/wp_shortlink_wp_head/
         */
        remove_action(
            hook_name: 'wp_head',
            callback: 'wp_shortlink_wp_head',
            priority: 10
        );

        /**
         * Removing RSS feeds
         *
         * @see https://developer.wordpress.org/reference/functions/feed_links/
         */
        remove_action(hook_name: 'wp_head', callback: 'feed_links', priority: 2);
        remove_action(hook_name: 'wp_head', callback: 'feed_links_extra', priority: 3);

        /**
         * Removing `<link rel='https://api.w.org/' href='http://link.net/wp-json/' />`
         *
         * @see https://developer.wordpress.org/reference/functions/rest_output_link_wp_head/
         */
        remove_action(
            hook_name: 'wp_head',
            callback: 'rest_output_link_wp_head',
            priority: 10
        );
        remove_action(
            hook_name: 'template_redirect',
            callback: 'rest_output_link_header',
            priority: 11
        );

        /**
         * Removing `<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />`
         *
         * @see https://developer.wordpress.org/reference/functions/wlwmanifest_link/
         */
        remove_action(hook_name: 'wp_head', callback: 'wlwmanifest_link');
    }
}
