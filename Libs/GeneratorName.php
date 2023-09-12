<?php

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

use WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

/**
 * removing <meta name="generator" content="WordPress x.y.z" />
 */
class GeneratorName implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        remove_action('wp_head', 'wp_generator');
    }
}
