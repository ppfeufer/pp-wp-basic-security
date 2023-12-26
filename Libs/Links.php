<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

class Links implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        /**
         * Removing <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />
         */
        remove_action(hook_name: 'wp_head', callback: 'rsd_link');

        /**
         * Removing relational next/prev links
         */
        remove_action(
            hook_name: 'wp_head', callback: 'adjacent_posts_rel_link', priority: 10
        );
        remove_action(
            hook_name: 'wp_head', callback: 'adjacent_posts_rel_link_wp_head', priority: 10
        );

        /**
         * Removing shortlink
         */
        remove_action(
            hook_name: 'wp_head', callback: 'wp_shortlink_wp_head', priority: 10
        );

        /**
         * Removing RSS feeds
         */
        remove_action(hook_name: 'wp_head', callback: 'feed_links', priority: 2);
        remove_action(hook_name: 'wp_head', callback: 'feed_links_extra', priority: 3);

        /**
         * Removing <link rel='https://api.w.org/' href='http://link.net/wp-json/' />
         */
        remove_action(
            hook_name: 'wp_head', callback: 'rest_output_link_wp_head', priority: 10
        );
        remove_action(
            hook_name: 'template_redirect', callback: 'rest_output_link_header', priority: 11
        );

        /**
         * Removing <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />
         */
        remove_action(hook_name: 'wp_head', callback: 'wlwmanifest_link');
    }
}
