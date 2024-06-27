<?php

/**
 * Remove emoji support
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;
use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Remove emoji support
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Emoji extends GenericSingleton implements GenericInterface {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting('wp-basic-security', 'wp-basic-security-tweaks', 'tweak_emoji')) {
            $this->execute();
        }
    }

    /**
     * Disable the tinymce emojicons
     *
     * @param array $plugins The plugins
     * @return array
     * @access public
     */
    public function disableTinymceEmojicons(array $plugins): array {
        return array_diff($plugins, ['wpemoji']);
    }

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array {
        return [
            'id' => 'tweak_emoji',
            'title' => __('Emoji Support', 'pp-wp-basic-security'),
            'desc' => __('Disable Emoji Support', 'pp-wp-basic-security'),
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
        remove_action(
            hook_name: 'wp_head',
            callback: 'print_emoji_detection_script',
            priority: 7
        );
        remove_action(hook_name: 'wp_print_styles', callback: 'print_emoji_styles');
        remove_action(
            hook_name: 'admin_print_scripts',
            callback: 'print_emoji_detection_script'
        );
        remove_action(hook_name: 'wp_print_styles', callback: 'print_emoji_styles');

        remove_filter(hook_name: 'wp_mail', callback: 'wp_staticize_emoji_for_email');
        remove_filter(hook_name: 'the_content_feed', callback: 'wp_staticize_emoji');
        remove_filter(hook_name: 'comment_text_rss', callback: 'wp_staticize_emoji');

        add_filter(
            hook_name: 'tiny_mce_plugins',
            callback: [$this, 'disableTinymceEmojicons']
        );
    }
}
