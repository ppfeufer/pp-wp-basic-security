<?php

namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

use WordPress\Plugin\PP_WP_Basic_Security\Libs\Interfaces\GenericInterface;

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
