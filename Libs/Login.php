<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

class Login implements GenericInterface {

    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        add_filter(
            hook_name: 'login_errors', callback: [$this, 'removeLoginErrorMessages']
        );
    }

    public function removeLoginErrorMessages(): ?string {
        return __(text: 'Ups! Something went wrong!', domain: 'pp-wp-basic-security');
    }
}
