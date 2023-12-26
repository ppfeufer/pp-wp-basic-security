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

// Include the autoloader, so we can dynamically include the rest of the classes.
require_once(trailingslashit(string: __DIR__) . 'inc/autoloader.php');
require_once(trailingslashit(string: __DIR__) . 'Libs/YahnisElsts/PluginUpdateChecker/plugin-update-checker.php');

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\YahnisElsts\PluginUpdateChecker\v5\PucFactory;

const WP_GITHUB_FORCE_UPDATE = false;

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
                domain: $this->textDomain, plugin_rel_path: $this->localizationDirectory
            );
        }
    }

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
