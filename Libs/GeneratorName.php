<?php

/**
 * Remove the generator name from head
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

/**
 * Removing <meta name="generator" content="WordPress x.y.z" />
 */
class GeneratorName implements GenericInterface {
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
        remove_action(hook_name: 'wp_head', callback: 'wp_generator');
    }
}
