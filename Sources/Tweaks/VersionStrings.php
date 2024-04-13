<?php

/**
 * Remove the version string from enqueued css and js
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove the version string from enqueued css and js
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 * @access public
 */
class VersionStrings implements GenericInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        $this->execute();
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @since 1.0.0
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
     * @since 1.0.0
     * @access public
     */
    public function removeVersionStrings(string $src): string {
        if (strpos(haystack: $src, needle: 'ver=')) {
            $src = remove_query_arg(key: 'ver', query: $src);
        }

        return $src;
    }
}
