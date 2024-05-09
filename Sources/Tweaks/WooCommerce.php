<?php

/**
 * Remove the WooCommerce generator version
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove the WooCommerce generator version
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 * @access public
 */
class WooCommerce implements GenericInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_woocommerce')) {
            $this->execute();
        }
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function execute(): void {
        remove_action(hook_name: 'wp_head', callback: 'wc_generator_tag');
    }
}
