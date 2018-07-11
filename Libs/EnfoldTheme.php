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

/**
 * Removing the debug from html output when Enfold theme is used
 */
class EnfoldTheme implements \WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface {
    public function __construct() {
        $theme = \wp_get_theme(); // gets the current theme
        if($theme->name === 'Enfold' || $theme->parent_theme === 'Enfold') {
            $this->execute();
        }
    }

    public function execute() {
        \add_action('wp_loaded', array($this, 'removeAviaDebug') , 9999);
    }

    /**
     * Remove the Debug Comment when Enfold Theme is used.
     */
    public function removeAviaDebug() {
        \remove_action('wp_head', 'avia_debugging_info', 1000);
        \remove_action('admin_print_scripts', 'avia_debugging_info', 1000);
    } // END public function removeAviaDebug()
}
