<?php

/**
 * Copyright (C) 2017 H.-Peter Pfeufer
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

\defined('ABSPATH') or die();

class Links implements \WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute() {
        /**
         * removing <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />
         */
        \remove_action('wp_head', 'rsd_link');

        /**
         * removing relational next/prev links
         */
        \remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
        \remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

        /**
         * removing shortlink
         */
        \remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

        /**
         * removing RSS feeds
         */
        \remove_action('wp_head', 'feed_links', 2);
        \remove_action('wp_head', 'feed_links_extra', 3);

        /**
         * removing <link rel='https://api.w.org/' href='http://link.net/wp-json/' />
         */
        \remove_action('wp_head', 'rest_output_link_wp_head', 10);
        \remove_action('template_redirect', 'rest_output_link_header', 11, 0);

        /**
         * removing <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />
         */
        \remove_action('wp_head', 'wlwmanifest_link');
    }
}
