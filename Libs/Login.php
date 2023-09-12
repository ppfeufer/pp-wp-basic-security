<?php

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

use WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface;

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
