<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

/**
 * removing <meta name="generator" content="WordPress x.y.z" />
 */
class GeneratorName implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        remove_action(hook_name: 'wp_head', callback: 'wp_generator');
    }
}
