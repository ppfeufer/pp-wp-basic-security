<?php

/**
 * Remove the login error messages
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Remove the login error messages
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Login extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_login')) {
            $this->execute();
        }
    }

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array {
        return [
            'id' => 'tweak_login',
            'title' => __('Login Error Messages', 'pp-wp-basic-security'),
            'desc' => __('Remove the login error messages', 'pp-wp-basic-security'),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Execute the filters and so on
     *
     * @return void
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
     * @access public
     */
    public function removeLoginErrorMessages(): string {
        return __('Ups! Something went wrong!', 'pp-wp-basic-security');
    }
}
