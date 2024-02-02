<?php

/**
 * Remove the version string from enqueued css and js
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

/**
 * Remove the version string from enqueued css and js
 */
class VersionStrings implements GenericInterface {
    /**
     * Constructor
     */
    public function __construct() {
        $this->execute();
    }

    /**
     * Execute the filters and so on
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
     *
     * @return string
     */
    public function removeVersionStrings(string $src): string {
        if (strpos(haystack: $src, needle: 'ver=')) {
            $src = remove_query_arg(key: 'ver', query: $src);
        }

        return $src;
    }
}
