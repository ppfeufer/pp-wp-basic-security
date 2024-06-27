<?php

/**
 * Remove the canonical link from head
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Remove the canonical link from `<head>`
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Canonical extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_canonical')) {
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
            'id' => 'tweak_canonical',
            'title' => __('Canonical link', 'pp-wp-basic-security'),
            'desc' => __(
                'Remove the canonical link from the `<head>` section',
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
        remove_action(hook_name: 'embed_head', callback: 'rel_canonical');
        add_filter(hook_name: 'wpseo_canonical', callback: '__return_false');
    }
}
