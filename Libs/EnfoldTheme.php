<?php

/**
 * Removing the debug from html output when Enfold theme is used
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\Interfaces\GenericInterface;

defined(constant_name: 'ABSPATH') or die();

/**
 * Removing the debug from html output when Enfold theme is used
 */
class EnfoldTheme implements GenericInterface {
    /**
     * Constructor
     */
    public function __construct() {
        if (esc_html(text: get_template()) === 'Enfold') {
            $this->execute();
        }
    }

    /**
     * Execute the filters and so on
     */
    public function execute(): void {
        add_action(
            hook_name: 'wp_loaded', callback: [$this, 'removeAviaDebug'], priority: 9999
        );
    }

    /**
     * Remove the Debug Comment when Enfold Theme is used.
     */
    public function removeAviaDebug(): void {
        remove_action(
            hook_name: 'wp_head', callback: 'avia_debugging_info', priority: 9999999
        );
        remove_action(
            hook_name: 'admin_print_scripts',
            callback: 'avia_debugging_info',
            priority: 9999999
        );
    }
}
