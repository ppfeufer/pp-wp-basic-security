<?php

/**
 * Remove the oembed stuff
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Remove the oembed stuff
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Oembed extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_oembed')) {
            $this->execute();
        }
    }

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array {
        return [
            'id' => 'tweak_oembed',
            'title' => __('oEmbed', 'pp-wp-basic-security'),
            'desc' => __('Disable oEmbed discovery', 'pp-wp-basic-security'),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Execute the filters and so on
     *
     * @return void
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
