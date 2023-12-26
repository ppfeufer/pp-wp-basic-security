<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

class WooCommerce implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        /**
         * Remove WooCommerce generator version
         */
        remove_action(hook_name: 'wp_head', callback: 'wc_generator_tag');
    }
}
