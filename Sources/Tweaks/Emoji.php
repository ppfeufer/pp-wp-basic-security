<?php

/**
 * Remove emoji support
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

// Prevent direct file access
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Interfaces\GenericInterface;

/**
 * Remove emoji support
 */
class Emoji implements GenericInterface {
    /**
     * Constructor
     */
    public function __construct() {
        $this->execute();
    }

    /**
     * Execute the filters and so on
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

    /**
     * Disable the tinymce emojicons
     *
     * @param array $plugins
     *
     * @return array
     */
    public function disableTinymceEmojicons(array $plugins): array {
        return array_diff($plugins, ['wpemoji']);
    }
}
