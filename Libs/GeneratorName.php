<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

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
