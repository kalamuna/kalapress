<?php
/**
 * Container Class File
 *
 * Manages the dependency injection container for services in the theme.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core\Engine;

use KLPTheme\Core\Util\Logger;

/**
 * Container class for dependency injection.
 *
 * This class manages the registration and retrieval of service classes
 * within the theme. It allows for services to be registered and lazily instantiated
 * on demand. It also handles exceptions when services are not found and logs them accordingly.
 *
 * @package KLPTheme
 */
class Container {

	/**
	 * Stores the registered services.
	 *
	 * @var array<string>
	 */
	protected $services = [];

	/**
	 * Array of instantiated service objects.
	 *
	 * @var array<string>
	 */
	protected $instances = [];

	/**
	 * Registers a service class.
	 *
	 * @param string $name The name of the service to be registered.
	 * @param string|\Closure $class The service class name or closure to be registered.
	 */
	public function register( $name, $class ) {
		$this->services[ $name ] = $class;
	}

	/**
	 * Loads and instantiates a service class by name.
	 *
	 * If the service is not registered, it throws an Exception.
	 * Handles the service instantiation, supporting service definitions as closures.
	 *
	 * @param string $name The name of the service to be loaded.
	 * @return object The instantiated service object.
	 * @throws \Exception
	 */
	private function load( $name ) {
		if ( ! isset( $this->services[ $name ] ) ) {
			$exception = new \Exception( "Service class <b>{$name}</b> not registered." );
			Logger::handleException( $exception, true );
			throw $exception;
		}

		$class = $this->services[ $name ];
		return $class instanceof \Closure ? $class( $this ) : new $class();
	}

	/**
	 * Retrieves a service object by name.
	 *
	 * If the service has not been instantiated, it loads it.
	 *
	 * @param string $name The name of the service to be retrieved.
	 * @return object The service instance.
	 */
	public function get( $name ) {
		if ( ! isset( $this->instances[ $name ] ) ) {
			try {
				$this->instances[ $name ] = $this->load( $name );
			} catch (\Exception $e) {
				Logger::handleException( $e, true );
			}
		}

		return $this->instances[ $name ];
	}

	/**
	 * Alias for get() that provides a more expressive way to run a service.
	 *
	 * @param string $name The name of the service to be retrieved.
	 * @return object The service instance.
	 */
	public function run( $name ) {
		return $this->get( $name );
	}
}

