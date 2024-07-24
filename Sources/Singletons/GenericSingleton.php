<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons;

use Exception;

/**
 * General Singleton
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Singletons
 */
class GenericSingleton {
    /**
     * Holds the instances of this class or subclasses.
     *
     * @var array<class-string<static>, static> $instances The instances of this class or subclasses.
     */
    protected static array $instances = [];

    /**
     * Constructor
     *
     * A protected constructor to prevent creating a new instance of the
     * Singleton via the `new` operator from outside of this class.
     */
    protected function __construct() {
    }

    /**
     * Get instance.
     *
     * Returns the *Singleton* instance of this class.
     *
     * @return static The *Singleton* instance.
     */
    public static function getInstance(): static {
        $calledClass = static::class;

        if (!isset(self::$instances[$calledClass])) {
            self::$instances[$calledClass] = new $calledClass();
        }

        return self::$instances[$calledClass];
    }

    /**
     * Prevent the instance from being cloned.
     *
     * @return void
     */
    private function __clone() {
    }

    /**
     * Prevent from being unserialized.
     *
     * This method is public to comply with the PHP internals handling of unserialization.
     *
     * @return void
     * @throws Exception
     */
    public function __wakeup() {
        throw new Exception(message: 'Cannot unserialize a singleton.');
    }
}
