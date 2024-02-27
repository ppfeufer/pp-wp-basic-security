<?php

/**
 * Remove the X-Pingback header
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

/**
 * Remove the X-Pingback header
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 * @access public
 */
class Pingback implements GenericInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        $this->execute();
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function execute(): void {
        add_action(hook_name: 'wp', callback: static function () {
            header_remove(name: 'X-Pingback');
        }, priority: 1000);
    }
}
