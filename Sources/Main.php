<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;

/**
 * Main class
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity
 */
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
     * @uses loadTweaks()
     * @uses doUpdateCheck()
     */
    public function init(): void {
        $this->loadTextDomain();
        $this->loadSettings();
        $this->loadTweaks();
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
     * Load the tweaks
     *
     * @return void
     * @access public
     */
    public function loadTweaks(): void {
        $tweakClasses = Tweaks::getInstance()->getTweakClasses();

        foreach ($tweakClasses as $tweakClass) {
            $tweakClass::getInstance()->init();
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
