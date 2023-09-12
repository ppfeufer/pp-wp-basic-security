<?php

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

use WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface;

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
