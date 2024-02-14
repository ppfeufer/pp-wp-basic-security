<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces;

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

/**
 * Defines a common set of functions that any class
 * extending this interface should implement.
 */
interface GenericInterface {
    /**
     * Initialize the class
     */
    public function __construct();

    /**
     * Execute the filters and so on
     */
    public function execute();
}
