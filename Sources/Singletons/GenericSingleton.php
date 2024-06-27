<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons;

/**
 * General Singleton
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons
 */
class GenericSingleton {
    /**
     * Constructor
     */
    protected function __construct() {
    }

    /**
     * Get instance.
     *
     * @return GenericSingleton|array
     * @scope public
     */
    final public static function getInstance(): GenericSingleton|array {
        static $instances = [];

        $calledClass = static::class;

        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }

        return $instances[$calledClass];
    }

    final public function __clone() {
    }
}
