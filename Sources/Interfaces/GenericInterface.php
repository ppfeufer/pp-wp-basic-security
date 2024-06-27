<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces;

/**
 * Defines a common set of functions that any class
 * extending this interface should implement.
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces
 */
interface GenericInterface {
    /**
     * Initialize the class
     *
     * @return void
     * @access public
     */
    public function init(): void;

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array;

    /**
     * Execute the filters and so on
     *
     * @return void
     * @access public
     */
    public function execute(): void;
}
