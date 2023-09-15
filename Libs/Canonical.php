<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

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
