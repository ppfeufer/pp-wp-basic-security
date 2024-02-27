<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces;

defined('ABSPATH') or die();

/**
 * Defines a common set of functions that any class
 * extending this interface should implement.
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces
 * @since 1.0.0
 */
interface GenericInterface {
    /**
     * Initialize the class
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function __construct();

    /**
     * Execute the filters and so on
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function execute(): void;
}
