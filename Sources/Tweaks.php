<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons\GenericSingleton;

/**
 * Tweaks
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity
 */
class Tweaks extends GenericSingleton {
    /**
     * Get the tweak classes
     *
     * @return array
     * @access public
     */
    public function getTweakClasses(): array {
        $tweakClasses = [];
        $files = glob(pattern: PLUGIN_DIR . 'Sources/Tweaks/*.php');

        foreach ($files as $file) {
            $class = str_replace(search: '.php', replace: '', subject: basename($file));
            $class = '\\WordPress\\Ppfeufer\\Plugin\\WpBasicSecurity\\Tweaks\\' . $class;

            if (class_exists($class)) {
                $tweakClasses[] = $class;
            }
        }

        return $tweakClasses;
    }
}
