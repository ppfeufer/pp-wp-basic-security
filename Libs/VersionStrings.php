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

use WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class VersionStrings implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        add_filter('style_loader_src', [$this, 'removeVersionStrings'], 9999);
        add_filter('script_loader_src', [$this, 'removeVersionStrings'], 9999);
    }

    /**
     * Removing the version string from any enqueued css and js source
     *
     * @param string $src the css or js source
     *
     * @return string
     */
    public function removeVersionStrings( string $src): string {
        if(strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }

        return $src;
    }
}