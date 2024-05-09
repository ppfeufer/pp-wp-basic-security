<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

use WordPressSettingsFramework;

/**
 * Initialize plugin settings and settings page.
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity
 */
class Settings {
    /**
     * WordPress Settings Framework
     *
     * @var WordPressSettingsFramework
     * @scope private
     */
    private WordPressSettingsFramework $wpsf;

    /**
     * Constructor.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->wpsf = new WordPressSettingsFramework(
            settings_file: PP_WP_BASIC_SECURITY_PLUGIN_DIR . 'Settings/WordPressSecuritySettings.php',
            option_group: 'wp-basic-security'
        );

        $this->initialize();
    }

    /**
     * Initialize settings page and settings link in the plugin list.
     *
     * @return void
     * @scope public
     */
    public function initialize(): void {
        // Add admin menu.
        add_action(
            hook_name: 'admin_menu',
            callback: [$this, 'addSettingsPage'],
            priority: 20
        );

        // Add a settings link to plugin actions.
        add_action(
            hook_name: 'plugin_action_links_' . PP_WP_BASIC_SECURITY_PLUGIN_FILE,
            callback: [$this, 'pluginActionsLink']
        );

        // Add an optional settings validation filter (recommended).
//        add_filter(
//            hook_name: $this->wpsf->get_option_group() . '_settings_validate',
//            callback: [$this, 'validateSettings']
//        );
    }

    /**
     * Add the settings page to the admin menu.
     *
     * @return void
     * @scope public
     */
    public function addSettingsPage(): void {
        $this->wpsf->add_settings_page(
            args: [
                'parent_slug' => 'options-general.php',
                'page_title' => __('WP Basic Security Settings', 'pp-wp-basic-security'),
                'menu_title' => __('WP Basic Security', 'pp-wp-basic-security'),
                'capability' => 'edit_posts',
            ]
        );
    }

    /**
     * Add a link to the option page from the plugin list
     *
     * @param array $links Plugin Links.
     * @return array
     * @scope public
     */
    public function pluginActionsLink(array $links): array {
        $new_links = [];
        $new_links[] = sprintf(
            '<a href="' . admin_url(path: 'options-general.php?page=wp-basic-security') . '">%s</a>',
            __('Plugin Settings', 'pp-wp-basic-security')
        );

        return array_merge($new_links, $links);
    }

    /**
     * Validate settings before saving.
     *
     * @param array $input Settings input.
     * @return array
     * @scope public
     */
//    public function validateSettings(array $input): array {
//        return $input;
//    }
}
