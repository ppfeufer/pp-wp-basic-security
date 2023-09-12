<?php

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces;

defined('ABSPATH') or die();

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
