<?php

/**
 * Remove the X-Pingback header
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Remove the X-Pingback header
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Pingback extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_pingback')) {
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
            'id' => 'tweak_pingback',
            'title' => __('Pingback Header', 'pp-wp-basic-security'),
            'desc' => __('Remove the X-Pingback header', 'pp-wp-basic-security'),
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
        add_action(hook_name: 'wp', callback: static function () {
            header_remove(name: 'X-Pingback');
        }, priority: 1000);
    }
}
