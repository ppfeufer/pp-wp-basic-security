<?php

/**
 * Remove the generator name from head
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Removing `<meta name="generator" content="WordPress x.y.z" />`
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class GeneratorName extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_generator_name')) {
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
            'id' => 'tweak_generator_name',
            'title' => __('Generator Name', 'pp-wp-basic-security'),
            'desc' => __(
                'Remove the `<meta name="generator" content="WordPress x.y.z" />` tag from the `<head>` section',
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
        remove_action(hook_name: 'wp_head', callback: 'wp_generator');
    }
}
