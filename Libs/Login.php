<?php

/**
 * Remove the login error messages
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

/**
 * Remove the login error messages
 */
class Login implements GenericInterface {
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
        add_filter(
            hook_name: 'login_errors', callback: [$this, 'removeLoginErrorMessages']
        );
    }

    /**
     * Remove the login error messages
     *
     * @return string
     */
    public function removeLoginErrorMessages(): string {
        return __(text: 'Ups! Something went wrong!', domain: 'pp-wp-basic-security');
    }
}
