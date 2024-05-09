<?php

/**
 * Remove the oembed stuff
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove the oembed stuff
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 * @access public
 */
class Oembed implements GenericInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_oembed')) {
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
        remove_action(hook_name: 'wp_head', callback: 'wp_oembed_add_discovery_links');
        remove_action(hook_name: 'rest_api_init', callback: 'wp_oembed_register_route');
        remove_filter(
            hook_name: 'oembed_dataparse',
            callback: 'wp_filter_oembed_result',
            priority: 10
        );
        remove_action(hook_name: 'wp_head', callback: 'wp_oembed_add_host_js');
    }
}
