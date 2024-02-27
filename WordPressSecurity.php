<?php

/**
 * Plugin Name: WordPress Basic Security
 * Plugin URI: https://github.com/ppfeufer/pp-wp-basic-security
 * GitHub Plugin URI: https://github.com/ppfeufer/pp-wp-basic-security
 * Description: Removing all non-needed stuff from the HTML Output
 * Version: 1.1.2
 * Author: H. Peter Pfeufer
 * Author URI: https://ppfeufer.de
 * License: GPLv3
 * Text Domain: pp-wp-basic-security
 * Domain Path: /l10n
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

defined(constant_name: 'ABSPATH') or die();

/**
 * Include the autoloader, so we can dynamically include the rest of the classes.
 * Also include the update checker.
 */
require_once(trailingslashit(value: __DIR__) . 'inc/autoloader.php');
require_once(trailingslashit(value: __DIR__) . 'Libs/YahnisElsts/PluginUpdateChecker/plugin-update-checker.php');

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\YahnisElsts\PluginUpdateChecker\v5\PucFactory;

/**
 * Class WordPressSecurity
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity
 * @since 1.0.0
 */
class WordPressSecurity {
    /**
     * Text domain
     *
     * @var string $textDomain
     */
    private string $textDomain;

    /**
     * Localization directory
     *
     * @var string $localizationDirectory
     */
    private string $localizationDirectory;

    /**
     * WordPressSecurity constructor.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        /**
         * Initializing Variables
         */
        $this->textDomain = 'pp-wp-basic-security';
        $this->localizationDirectory = basename(path: __DIR__) . '/l10n/';
    }

    /**
     * Initialize the plugin
     *
     * @return void
     * @since 1.0.0
     * @access public
     * @uses loadTextDomain()
     * @uses loadLibraries()
     * @uses doUpdateCheck()
     */
    public function init(): void {
        $this->loadTextDomain();
        $this->loadLibraries();
        $this->doUpdateCheck();
    }

    /**
     * Load the text domain
     *
     * @return void
     * @since 1.0.0
     * @access public
     * @uses load_plugin_textdomain()
     */
    public function loadTextDomain(): void {
        if (function_exists(function: 'load_plugin_textdomain')) {
            load_plugin_textdomain(
                domain: $this->textDomain, plugin_rel_path: $this->localizationDirectory
            );
        }
    }

    /**
     * Load the libraries
     *
     * @return void
     * @since 1.0.0
     * @access public
     * @uses Libs\Canonical
     * @uses Libs\EnfoldTheme
     * @uses Libs\Emoji
     * @uses Libs\GeneratorName
     * @uses Libs\Links
     * @uses Libs\Oembed
     * @uses Libs\Pingback
     * @uses Libs\VersionStrings
     * @uses Libs\WooCommerce
     * @uses Libs\YoutubeEmbed
     * @uses Libs\Login
     */
    public function loadLibraries(): void {
        new Libs\Canonical;
        new Libs\EnfoldTheme;
        new Libs\Emoji;
        new Libs\GeneratorName;
        new Libs\Links;
        new Libs\Oembed;
        new Libs\Pingback;
        new Libs\VersionStrings;
        new Libs\WooCommerce;
        new Libs\YoutubeEmbed;
        new Libs\Login;
    }

    /**
     * Check for updates
     *
     * @return void
     * @since 1.0.0
     * @access public
     * @uses PucFactory::buildUpdateChecker()
     */
    public function doUpdateCheck(): void {
        /**
         * Check GitHub for updates
         */
        $myUpdateChecker = PucFactory::buildUpdateChecker(
            metadataUrl: 'https://github.com/ppfeufer/pp-wp-basic-security/',
            fullPath: __FILE__,
            slug: 'pp-wp-basic-security'
        );

        $myUpdateChecker->getVcsApi()->enableReleaseAssets();
    }
}

/**
 * Start the show …
 *
 * @return void
 * @since 1.0.0
 * @access public
 * @uses WordPressSecurity::init()
 */
function initialize_plugin(): void {
    $plugin = new WordPressSecurity;

    /**
     * Initialize the plugin
     */
    $plugin->init();
}

// Fire away!
initialize_plugin();
