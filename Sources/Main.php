<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

// phpcs:disable
require_once trailingslashit(value: __DIR__) . 'Libs/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\Canonical;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\Emoji;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\EnfoldTheme;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\GeneratorName;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\Links;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\Login;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\Oembed;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\Pingback;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\VersionStrings;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\WooCommerce;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\YoutubeEmbed;

class Main {
    /**
     * Text domain
     *
     * @var string $textDomain The text domain
     */
    private string $textDomain;

    /**
     * Localization directory
     *
     * @var string $localizationDirectory The localization directory
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
                domain: $this->textDomain,
                plugin_rel_path: $this->localizationDirectory
            );
        }
    }

    /**
     * Load the libraries
     *
     * @return void
     * @since 1.0.0
     * @access public
     * @uses Canonical
     * @uses EnfoldTheme
     * @uses Emoji
     * @uses GeneratorName
     * @uses Links
     * @uses Oembed
     * @uses Pingback
     * @uses VersionStrings
     * @uses WooCommerce
     * @uses YoutubeEmbed
     * @uses Login
     */
    public function loadLibraries(): void {
        new Canonical;
        new EnfoldTheme;
        new Emoji;
        new GeneratorName;
        new Links;
        new Oembed;
        new Pingback;
        new VersionStrings;
        new WooCommerce;
        new YoutubeEmbed;
        new Login;
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
            fullPath: PP_WP_BASIC_SECURITY_PLUGIN_DIR . 'WordPressSecurity.php',
            slug: 'pp-wp-basic-security'
        );

        $myUpdateChecker->getVcsApi()->enableReleaseAssets();
    }
}
