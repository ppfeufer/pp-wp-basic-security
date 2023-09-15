<?php

namespace WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs;

use WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class Oembed implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('rest_api_init', 'wp_oembed_register_route');
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        remove_action('wp_head', 'wp_oembed_add_host_js');
    }
}
