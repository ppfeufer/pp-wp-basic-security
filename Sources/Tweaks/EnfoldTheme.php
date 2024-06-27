<?php

/**
 * Removing the debug from html output when Enfold theme is used
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Removing the debug from html output when Enfold theme is used
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class EnfoldTheme extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_enfold_theme')
            && esc_html(text: get_template()) === 'Enfold'
        ) {
            $this->execute();
        }
    }

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array {
        return [
            'id' => 'tweak_enfold_theme',
            'title' => __('Enfold Debug', 'pp-wp-basic-security'),
            'desc' => __(
                'Remove the debug from html output when the Enfold theme is used',
                'pp-wp-basic-security'
            ),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Execute the filters and so on
     *
     * @return void
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
