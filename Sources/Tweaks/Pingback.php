<?php

/**
 * Remove the X-Pingback header
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove the X-Pingback header
 */
class Pingback implements GenericInterface {
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
        add_action(hook_name: 'wp', callback: static function () {
            header_remove(name: 'X-Pingback');
        }, priority: 1000);
    }
}
