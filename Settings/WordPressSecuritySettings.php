<?php

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Tweaks;

function wordpress_security_settings(array $wpsf_settings): array {
    $tweakClasses = Tweaks::getInstance()->getTweakClasses();
    $settingsFields = [];

    foreach ($tweakClasses as $tweakClass) {
        $settingsFields[] = $tweakClass::getInstance()->getSettings();
    }

    $wpsf_settings[] = [
        'section_id' => 'wp-basic-security-tweaks',
        'section_title' => __('Security Tweaks', 'pp-wp-basic-security'),
        'section_description' => __(
            'Select which security tweaks you want to apply …',
            'pp-wp-basic-security'
        ),
        'section_order' => 5,
        'fields' => $settingsFields
    ];

    return $wpsf_settings;
}

// phpcs:disable
add_filter(
    hook_name: 'wpsf_register_settings_wp-basic-security',
    callback: 'wordpress_security_settings'
);
// phpcs:enable
