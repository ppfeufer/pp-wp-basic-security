<?php

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

use WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class Canonical implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        remove_action('embed_head', 'rel_canonical');
        add_filter('wpseo_canonical', '__return_false');
    }
}
