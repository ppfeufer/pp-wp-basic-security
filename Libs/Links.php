<?php

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

use WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class Links implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        /**
         * Removing <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />
         */
        remove_action('wp_head', 'rsd_link');

        /**
         * Removing relational next/prev links
         */
        remove_action('wp_head', 'adjacent_posts_rel_link', 10);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

        /**
         * Removing shortlink
         */
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);

        /**
         * Removing RSS feeds
         */
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);

        /**
         * Removing <link rel='https://api.w.org/' href='http://link.net/wp-json/' />
         */
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('template_redirect', 'rest_output_link_header', 11);

        /**
         * Removing <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />
         */
        remove_action('wp_head', 'wlwmanifest_link');
    }
}
