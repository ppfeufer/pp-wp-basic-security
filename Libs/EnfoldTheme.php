<?php

namespace WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs;

use WordPress\Plugin\Ppfeufer\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined('ABSPATH') or die();

/**
 * Removing the debug from html output when Enfold theme is used
 */
class EnfoldTheme implements GenericInterface {
    public function __construct() {
        if (esc_html(get_template()) === 'Enfold') {
            $this->execute();
        }
    }

    public function execute(): void {
        add_action('wp_loaded', [$this, 'removeAviaDebug'], 9999);
    }

    /**
     * Remove the Debug Comment when Enfold Theme is used.
     */
    public function removeAviaDebug(): void {
        remove_action('wp_head', 'avia_debugging_info', 9999999);
        remove_action('admin_print_scripts', 'avia_debugging_info', 9999999);
    }
}
