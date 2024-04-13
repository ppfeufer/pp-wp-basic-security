<?php

/**
 * Plugin Name: WordPress Basic Security
 * Plugin URI: https://github.com/ppfeufer/pp-wp-basic-security
 * GitHub Plugin URI: https://github.com/ppfeufer/pp-wp-basic-security
 * Description: Removing all non-needed stuff from the HTML Output
 * Version: 1.1.2
 * Author: H. Peter Pfeufer
 * Author URI: https://ppfeufer.de
 * License: GPLv3
 * Text Domain: pp-wp-basic-security
 * Domain Path: /l10n
 */

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

// phpcs:disable
define(
    constant_name: 'PP_WP_BASIC_SECURITY_PLUGIN_DIR',
    value: plugin_dir_path(file: __FILE__)
);

require_once trailingslashit(value: __DIR__) . 'Sources/autoloader.php';
require_once trailingslashit(value: __DIR__) . 'Sources/Libs/autoload.php';
// phpcs:enable

// Load the plugin's main class.
(new Main())->init();
