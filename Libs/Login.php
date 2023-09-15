<?php

namespace WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs;

use WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class Login implements GenericInterface {

    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        add_filter('login_errors', [$this, 'removeLoginErrorMessages']);
    }

    public function removeLoginErrorMessages(): ?string {
        return __('Ups! Something went wrong!', 'pp-wp-basic-security');
    }
}
