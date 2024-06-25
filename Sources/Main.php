<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

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
     * @access public
     * @uses loadTextDomain()
     * @uses loadLibraries()
     * @uses doUpdateCheck()
     */
    public function init(): void {
        $this->loadTextDomain();
        $this->loadSettings();
        $this->loadLibraries();
        $this->doUpdateCheck();
    }

    /**
     * Load the text domain
     *
     * @return void
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
     * Load the settings
     *
     * @return void
     * @access public
     * @uses Settings
     */
    public function loadSettings(): void {
        new Settings;
    }

    /**
     * Get the libraries
     *
     * @return array
     * @access private
     */
    private function getTweakClasses(): array {
        return [
            Canonical::class,
            Emoji::class,
            EnfoldTheme::class,
            GeneratorName::class,
            Links::class,
            Login::class,
            Oembed::class,
            Pingback::class,
            VersionStrings::class,
            WooCommerce::class,
            YoutubeEmbed::class
        ];
    }

    /**
     * Load the libraries
     *
     * @return void
     * @access public
     */
    public function loadLibraries(): void {
        $tweakClasses = $this->getTweakClasses();

        foreach ($tweakClasses as $tweakClass) {
            new $tweakClass;
        }
    }

    /**
     * Check for updates
     *
     * @return void
     * @access public
     * @uses PucFactory::buildUpdateChecker()
     */
    public function doUpdateCheck(): void {
        /**
         * Check GitHub for updates
         */
        $myUpdateChecker = PucFactory::buildUpdateChecker(
            metadataUrl: 'https://github.com/ppfeufer/pp-wp-basic-security/',
            fullPath: PLUGIN_DIR . 'WordPressSecurity.php',
            slug: 'pp-wp-basic-security'
        );

        $myUpdateChecker->getVcsApi()->enableReleaseAssets();
    }
}
