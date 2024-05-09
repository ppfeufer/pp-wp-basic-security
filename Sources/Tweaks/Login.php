<?php

/**
 * Remove the login error messages
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

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
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_login')) {
            $this->execute();
        }
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
            hook_name: 'login_errors',
            callback: [$this, 'removeLoginErrorMessages']
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
        return __('Ups! Something went wrong!', 'pp-wp-basic-security');
    }
}
