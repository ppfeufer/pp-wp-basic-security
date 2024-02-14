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

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

// Include the autoloader, so we can dynamically include the rest of the classes.
// phpcs:disable
require_once trailingslashit(value: __DIR__) . 'vendor/autoload.php';
require_once trailingslashit(value: __DIR__) . 'vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks\CanonicalLinks;
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
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// Define the constant for the update check
// phpcs:disable
const WP_GITHUB_FORCE_UPDATE = false;
// phpcs:enable

class WordPressSecurity {
    /**
     * Text domain
     *
     * @var string|null
     */
    private ?string $textDomain;

    /**
     * Localization directory
     *
     * @var string|null
     */
    private ?string $localizationDirectory;

    public function __construct() {
        /**
         * Initializing Variables
         */
        $this->textDomain = 'pp-wp-basic-security';
        $this->localizationDirectory = basename(path: __DIR__) . '/l10n/';
    }

    public function init(): void {
        $this->loadTextDomain();
        $this->loadLibraries();
        $this->doUpdateCheck();
    }

    public function loadTextDomain(): void {
        if (function_exists(function: 'load_plugin_textdomain')) {
            load_plugin_textdomain(
                domain: $this->textDomain,
                plugin_rel_path: $this->localizationDirectory
            );
        }
    }

    public function loadLibraries(): void {
        new CanonicalLinks();
        new Emoji();
        new EnfoldTheme();
        new GeneratorName();
        new Links();
        new Login();
        new Oembed();
        new Pingback();
        new VersionStrings();
        new WooCommerce();
        new YoutubeEmbed();
    }

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

// Initialize the plugin
// phpcs:disable
(new WordPressSecurity())->init();
// phpcs:enable
