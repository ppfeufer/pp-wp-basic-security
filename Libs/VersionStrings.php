<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class VersionStrings implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        add_filter('style_loader_src', [$this, 'removeVersionStrings'], 9999);
        add_filter('script_loader_src', [$this, 'removeVersionStrings'], 9999);
    }

    /**
     * Removing the version string from any enqueued css and js source
     *
     * @param string $src the css or js source
     *
     * @return string
     */
    public function removeVersionStrings(string $src): string {
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }

        return $src;
    }
}
