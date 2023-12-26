<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

class Oembed implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

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
