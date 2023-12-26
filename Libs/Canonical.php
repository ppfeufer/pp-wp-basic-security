<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

class Canonical implements GenericInterface {
    public function __construct() {
        $this->execute();
    }

    public function execute(): void {
        remove_action(hook_name: 'embed_head', callback: 'rel_canonical');
        add_filter(hook_name: 'wpseo_canonical', callback: '__return_false');
    }
}
