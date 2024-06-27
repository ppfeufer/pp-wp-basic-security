<?php

/**
 * Remove the version string from enqueued css and js
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Remove the version string from enqueued css and js
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class VersionStrings extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_version_strings')) {
            $this->execute();
        }
    }

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array {
        return [
            'id' => 'tweak_version_strings',
            'title' => __('Version Strings', 'pp-wp-basic-security'),
            'desc' => __('Remove the WordPress version from the scripts and styles', 'pp-wp-basic-security'),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @access public
     */
    public function execute(): void {
        add_filter(
            hook_name: 'style_loader_src',
            callback: [$this, 'removeVersionStrings'],
            priority: 9999
        );
        add_filter(
            hook_name: 'script_loader_src',
            callback: [$this, 'removeVersionStrings'],
            priority: 9999
        );
    }

    /**
     * Removing the version string from any enqueued css and js source
     *
     * @param string $src the css or js source
     * @return string
     * @access public
     */
    public function removeVersionStrings(string $src): string {
        if (strpos(haystack: $src, needle: 'ver=')) {
            $src = remove_query_arg(key: 'ver', query: $src);
        }

        return $src;
    }
}
