<?php

function wordpress_security_settings(array $wpsf_settings): array {
    $wpsf_settings[] = [
        'section_id' => 'wp-basic-security-tweaks',
        'section_title' => __('Security Tweaks', 'pp-wp-basic-security'),
        'section_description' => __(
            'Select which security tweaks you want to apply …',
            'pp-wp-basic-security'
        ),
        'section_order' => 5,
        'fields' => [
            [
                'id' => 'tweak_canonical',
                'title' => __('Canonical link', 'pp-wp-basic-security'),
                'desc' => __(
                    'Remove the canonical link from the `<head>` section',
                    'pp-wp-basic-security'
                ),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_emoji',
                'title' => __('Emoji Support', 'pp-wp-basic-security'),
                'desc' => __('Disable Emoji Support', 'pp-wp-basic-security'),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_enfold_theme',
                'title' => __('Enfold Debug', 'pp-wp-basic-security'),
                'desc' => __(
                    'Remove the debug from html output when the Enfold theme is used',
                    'pp-wp-basic-security'
                ),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_generator_name',
                'title' => __('Generator Name', 'pp-wp-basic-security'),
                'desc' => __(
                    'Remove the `<meta name="generator" content="WordPress x.y.z" />` tag from the `<head>` section',
                    'pp-wp-basic-security'
                ),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_links',
                'title' => __('Meta Links Tags', 'pp-wp-basic-security'),
                'desc' => __(
                    'Remove some definitions from the `<head>` section, like XMLRPC header, RSS feeds and WLW Manifests',
                    'pp-wp-basic-security'
                ),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_login',
                'title' => __('Login Error Messages', 'pp-wp-basic-security'),
                'desc' => __('Remove the login error messages', 'pp-wp-basic-security'),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_oembed',
                'title' => __('oEmbed', 'pp-wp-basic-security'),
                'desc' => __('Disable oEmbed discovery', 'pp-wp-basic-security'),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_pingback',
                'title' => __('Pingback Header', 'pp-wp-basic-security'),
                'desc' => __('Remove the X-Pingback header', 'pp-wp-basic-security'),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_version_strings',
                'title' => __('Version Strings', 'pp-wp-basic-security'),
                'desc' => __('Remove the WordPress version from the scripts and styles', 'pp-wp-basic-security'),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_woocommerce',
                'title' => __('WooCommerce', 'pp-wp-basic-security'),
                'desc' => __('Remove the WooCommerce generator tag', 'pp-wp-basic-security'),
                'type' => 'checkbox',
                'default' => 0
            ],
            [
                'id' => 'tweak_youtube_embed',
                'title' => __('YouTube Embed (no cookie)', 'pp-wp-basic-security'),
                'desc' => __('Change the YouTube embed to use the no-cookie domain', 'pp-wp-basic-security'),
                'type' => 'checkbox',
                'default' => 0
            ]
        ],
    ];

    return $wpsf_settings;
}

// phpcs:disable
add_filter(
    hook_name: 'wpsf_register_settings_wp-basic-security',
    callback: 'wordpress_security_settings'
);
// phpcs:enable
