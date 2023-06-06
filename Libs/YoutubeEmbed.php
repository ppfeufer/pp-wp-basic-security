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
