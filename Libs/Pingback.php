<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

class Pingback implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        add_action('wp', static function () {
            header_remove('X-Pingback');
        }, 1000);
    }
}
