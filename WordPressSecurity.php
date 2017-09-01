<?php

/**
 * Plugin Name: PP WordPress Basic Security
 * Plugin URI: https://github.com/ppfeufer/pp-wp-basic-security
 * GitHub Plugin URI: https://github.com/ppfeufer/pp-wp-basic-security
 * Description: Removing all non needed stuff from the HTML Output
 * Version: 0.1-r20170901
 * Author: H.-Peter Pfeufer
 * Author URI: https://ppfeufer.de
 * License: GPLv3
 */

/*
Copyright (C) 2017 p.pfeufer

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

namespace WordPress\Plugin\PP_WP_Basic_Security;

\defined('ABSPATH') or die();

// Include the autoloader so we can dynamically include the rest of the classes.
require_once(\trailingslashit(\dirname(__FILE__)) . 'inc/autoloader.php');
const WP_GITHUB_FORCE_UPDATE = true;

class WordPressSecurity {
	public function init() {
		new Libs\Canonical;
		new Libs\Enfoldtheme;
		new Libs\Emoji;
		new Libs\GeneratorName;
		new Libs\Links;
		new Libs\Oembed;
		new Libs\Pingback;
		new Libs\VersionStrings;
		new Libs\WooCommerce;

		if(\is_admin()) {
			/**
			 * Check Github for updates
			 */
			$githubConfig = [
				'slug' => \plugin_basename(__FILE__),
				'proper_folder_name' => \dirname(\plugin_basename(__FILE__)),
				'api_url' => 'https://api.github.com/repos/ppfeufer/pp-wp-basic-security',
				'raw_url' => 'https://raw.github.com/ppfeufer/pp-wp-basic-security/master',
				'github_url' => 'https://github.com/ppfeufer/pp-wp-basic-security',
				'zip_url' => 'https://github.com/ppfeufer/pp-wp-basic-security/archive/master.zip',
				'sslverify' => true,
				'requires' => '4.7',
				'tested' => '4.9-alpha',
				'readme' => 'README.md',
				'access_token' => '',
			];

			new Libs\GithubUpdater($githubConfig);
		} // END if(\is_admin())
	} // END public function init()
} // END class Security

/**
 * Start the show ....
 */
function initializePlugin() {
	$plugin = new WordPressSecurity;

	/**
	 * Initialize the plugin
	 */
	$plugin->init();
} // END function initializePlugin()

// Hook me up baby!
\add_action('plugins_loaded', '\WordPress\Plugin\PP_WP_Basic_Security\initializePlugin');
