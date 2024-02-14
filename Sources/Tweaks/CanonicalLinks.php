<?php

/**
 * Remove the canonical link from head
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove the canonical link from head
 */
class CanonicalLinks implements GenericInterface {
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
        remove_action(hook_name: 'embed_head', callback: 'rel_canonical');
        add_filter(hook_name: 'wpseo_canonical', callback: '__return_false');
    }
}
