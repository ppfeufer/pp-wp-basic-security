<?php

/**
 * Remove the login error messages
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

/**
 * Remove the login error messages
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 * @access public
 */
class Login implements GenericInterface {
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
        add_filter(
            hook_name: 'login_errors', callback: [$this, 'removeLoginErrorMessages']
        );
    }

    /**
     * Relace the login error messages with a generic one
     *
     * @return string
     * @since 1.0.0
     * @access public
     */
    public function removeLoginErrorMessages(): string {
        return __(text: 'Ups! Something went wrong!', domain: 'pp-wp-basic-security');
    }
}
