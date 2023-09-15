<?php

namespace WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs;

use WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs\Interfaces\GenericInterface;

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
