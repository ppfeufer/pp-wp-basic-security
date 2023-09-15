<?php

namespace WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs;

use WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class WooCommerce implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        /**
         * Remove WooCommerce generator version
         */
        remove_action('wp_head', 'wc_generator_tag');
    }
}
