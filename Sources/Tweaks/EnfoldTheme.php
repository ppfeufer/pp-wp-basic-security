<?php

/**
 * Removing the debug from html output when Enfold theme is used
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Removing the debug from html output when Enfold theme is used
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @since 1.0.0
 */
class EnfoldTheme implements GenericInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_enfold_theme')
            && esc_html(text: get_template()) === 'Enfold'
        ) {
            $this->execute();
        }
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function execute(): void {
        add_action(
            hook_name: 'wp_loaded',
            callback: [$this, 'removeAviaDebug'],
            priority: 9999
        );
    }

    /**
     * Remove the Debug Comment when Enfold Theme is used.
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function removeAviaDebug(): void {
        remove_action(
            hook_name: 'wp_head',
            callback: 'avia_debugging_info',
            priority: 9999999
        );
        remove_action(
            hook_name: 'admin_print_scripts',
            callback: 'avia_debugging_info',
            priority: 9999999
        );
    }
}
