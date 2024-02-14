<?php

/**
 * Remove some link definitions link from head
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove some link definitions link from head
 */
class Links implements GenericInterface {
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
        /**
         * Removing <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />
         */
        remove_action(hook_name: 'wp_head', callback: 'rsd_link');

        /**
         * Removing relational next/prev links
         */
        remove_action(hook_name: 'wp_head', callback: 'adjacent_posts_rel_link');
        remove_action(hook_name: 'wp_head', callback: 'adjacent_posts_rel_link_wp_head');

        /**
         * Removing shortlink
         */
        remove_action(hook_name: 'wp_head', callback: 'wp_shortlink_wp_head');

        /**
         * Removing RSS feeds
         */
        remove_action(hook_name: 'wp_head', callback: 'feed_links', priority: 2);
        remove_action(hook_name: 'wp_head', callback: 'feed_links_extra', priority: 3);

        /**
         * Removing <link rel='https://api.w.org/' href='http://link.net/wp-json/' />
         */
        remove_action(hook_name: 'wp_head', callback: 'rest_output_link_wp_head');
        remove_action(
            hook_name: 'template_redirect',
            callback: 'rest_output_link_header',
            priority: 11
        );

        /**
         * Removing <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />
         */
        remove_action(hook_name: 'wp_head', callback: 'wlwmanifest_link');
    }
}
