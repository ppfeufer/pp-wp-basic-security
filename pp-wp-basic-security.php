<?php

/*
Plugin Name: PP WordPress Basic Security
Plugin URI: https://github.com/ppfeufer/pp-wp-basic-security
Description: Removing all non needed stuff from the HTML Output
Version: 1.0.0
Author: H.-Peter Pfeufer
Author URI: https://ppfeufer.de
License: GPLv3
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

namespace WordPress\Plugins\PP_WP_Basic_Security;

\defined('ABSPATH') or die();

class WordPressSecurity {
	public function __construct() {
		$this->removeGeneratorName();
		$this->removeBlogClientLink();
		$this->removeLiveWriterManifest();
		$this->removeOembedLink();
		$this->removeRestApiLink();
		$this->removeXPingback();
		$this->removeEmojis();
		$this->removeRelationalLinks();
		$this->removeShortlink();
		$this->removeFeedLinks();
		$this->additionalFilterAndActions();
	} // END public function __construct()

	public function additionalFilterAndActions() {
		\add_filter('style_loader_src', array($this, 'removeVersionStrings'), 9999);
		\add_filter('script_loader_src', array($this, 'removeVersionStrings'), 9999);

		// Removing debug from html output when Enfold theme is used
		$theme = \wp_get_theme(); // gets the current theme
		if($theme->name === 'Enfold' || $theme->parent_theme === 'Enfold') {
			\add_action('wp_loaded', array($this, 'removeAviaDebug') , 9999);
		} // END if($theme->name === 'Enfold' || $theme->parent_theme === 'Enfold')
	} // END public function additionalFilter()

	/**
	 * removing <meta name="generator" content="WordPress x.y.z" />
	 */
	public function removeGeneratorName() {
		\remove_action('wp_head', 'wp_generator');
	} // END public function removeGeneratorName()

	/**
	 * removing <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />
	 */
	public function removeBlogClientLink() {
		\remove_action('wp_head', 'rsd_link');
	} // END public function removeBlogClientLink()

	/**
	 * removing <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />
	 */
	public function removeLiveWriterManifest() {
		\remove_action('wp_head', 'wlwmanifest_link');
	} // END public function removeLiveWriterManifest()

	/**
	 * removing all oEmbed stuff to embed our own site
	 */
	public function removeOembedLink() {
		\remove_action('wp_head', 'wp_oembed_add_discovery_links');
		\remove_action('rest_api_init', 'wp_oembed_register_route');
		\remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
		\remove_action('wp_head', 'wp_oembed_add_host_js');
	} // END public function removeOembedLink()

	/**
	 * removing <link rel='https://api.w.org/' href='http://link.net/wp-json/' />
	 */
	public function removeRestApiLink() {
		\remove_action('wp_head', 'rest_output_link_wp_head', 10);
		\remove_action('template_redirect', 'rest_output_link_header', 11, 0);
	} // END public function removeRestApiLink()

	/**
	 * removing X-Pingback
	 */
	public function removeXPingback() {
		\add_action('wp', function() {
			\header_remove('X-Pingback');
		}, 1000);
	} // END public function removeXPingback()

	/**
	 * removing Emojis
	 */
	public function removeEmojis() {
		\remove_action('wp_head', 'print_emoji_detection_script', 7);
		\remove_action('wp_print_styles', 'print_emoji_styles');
	} // END public function removeEmojis()

	/**
	 * removing relational next/prev links
	 */
	public function removeRelationalLinks() {
		\remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
	} // END public function removeRelationalLinks()

	/**
	 * removing shortlink
	 */
	public function removeShortlink() {
		\remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	} // END public function removeShortlink()

	/**
	 * removing RSS feeds
	 */
	public function removeFeedLinks() {
		\remove_action('wp_head', 'feed_links', 2);
		\remove_action('wp_head', 'feed_links_extra', 3);
	} // END public function removeFeedLinks()

	/**
	 * Removing the version string from any enqueued css and js source
	 *
	 * @param string $src the css or js source
	 * @return string
	 */
	public function removeVersionStrings($src) {
		if(strpos($src, 'ver=')) {
			$src = \remove_query_arg('ver', $src);
		} // END if(strpos($src, 'ver=' . get_bloginfo('version')))

		return $src;
	} // END function yf_remove_wp_ver_css_js($src)

	/**
	 * Remove the Debug Comment when Enfold Theme is used.
	 */
	public function removeAviaDebug() {
		\remove_action('wp_head', 'avia_debugging_info', 1000);
		\remove_action('admin_print_scripts', 'avia_debugging_info', 1000);
	} // END public function removeAviaDebug()
} // END class Security

new WordPressSecurity;
