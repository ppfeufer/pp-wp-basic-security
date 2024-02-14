<?php

/**
 * Remove the WooCommerce generator version
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove the WooCommerce generator version
 */
class WooCommerce implements GenericInterface {
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
        /**
         * Remove WooCommerce generator version
         */
        remove_action(hook_name: 'wp_head', callback: 'wc_generator_tag');
    }
}
