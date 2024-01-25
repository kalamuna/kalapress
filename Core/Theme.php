<?php
/**
 * Theme Initialization class file.
 *
 * This file contains the Theme class which sets up the core functionality
 * of the theme by initializing various components such as assets, custom
 * post types, taxonomies, blocks, and other theme-specific setup requirements.
 * It leverages a container for dependency injection and service management.
 *
 * @package KLPTheme
 * @author Kalamuna
 */

namespace KLPTheme\Core;

use KLPTheme\Core\Engine\Container;
use KLPTheme\Config\AssetsConfig;
use KLPTheme\Config\BlocksConfig;
use KLPTheme\Config\PostTypesConfig;
use KLPTheme\Config\TaxonomiesConfig;
use KLPTheme\Config\BlockStylesConfig;
use KLPTheme\Core\Engine\HandleAssets;
use KLPTheme\Core\Engine\HandlePostTypes;
use KLPTheme\Core\Engine\HandleTaxonomies;
use KLPTheme\Core\Engine\HandleThemeSetup;
use KLPTheme\Config\BlockCategoriesConfig;
use KLPTheme\Config\IncludedFunctionsConfig;
use KLPTheme\Core\Engine\HandleBuildArtifacts;
use KLPTheme\Core\Engine\HandleRegisterBlockStyles;
use KLPTheme\Core\Engine\HandleRegisterBlocks;
use KLPTheme\Core\Engine\HandleBlockCategories;
use KLPTheme\Config\BlockPatternCategoriesConfig;
use KLPTheme\Core\Engine\HandleIncludedFunctions;
use KLPTheme\Core\Engine\HandleBlockPatternCategories;

/**
 * Class Theme
 *
 * Main class for the theme. It initializes the service container and
 * loads all the necessary services and configurations for the theme to function.
 * This includes setting up custom post types, taxonomies, block types,
 * enqueuing assets, and more.
 *
 * @package KLPTheme\Core
 */
class Theme {

	/**
	 * Constructs the Theme object and starts the bootstrapping process.
	 */
	public function __construct() {
		$this->bootstrap();
	}

	/**
	 * Initialize the container and load the services.
	 *
	 * This method sets up the dependency injection container and registers
	 * all services and configurations required by the theme. Each service
	 * is responsible for a specific part of the theme's functionality, and
	 * they are all initialized here.
	 * @uses KLPTheme\Core\Engine\Container - Dependency injection container.
	 */
	private function bootstrap() {
		$container = new Container();

		// Register services with configurations
		$container->register( 'BlocksConfig', BlocksConfig::class);
		$container->register( 'HandleRegisterBlocks', fn( $container ) =>
			new HandleRegisterBlocks( $container->get( 'BlocksConfig' ) ) );

		$container->register( 'HandleBuildArtifacts', fn( $container ) =>
			new HandleBuildArtifacts( $container->get( 'BlocksConfig' ) )
		);

		$container->register( 'AssetsConfig', AssetsConfig::class);
		$container->register( 'HandleAssets', fn( $container ) =>
			new HandleAssets( $container->get( 'AssetsConfig' ) ) );

		$container->register( 'PostTypesConfig', PostTypesConfig::class);
		$container->register( 'HandlePostTypes', fn( $container ) =>
			new HandlePostTypes( $container->get( 'PostTypesConfig' ) ) );

		$container->register( 'TaxonomiesConfig', TaxonomiesConfig::class);
		$container->register( 'HandleTaxonomies', fn( $container ) =>
			new HandleTaxonomies( $container->get( 'TaxonomiesConfig' ) ) );

		$container->register( 'BlockCategoriesConfig', BlockCategoriesConfig::class);
		$container->register( 'HandleBlockCategories', fn( $container ) =>
			new HandleBlockCategories( $container->get( 'BlockCategoriesConfig' ) ) );

		$container->register( 'BlockPatternCategoriesConfig', BlockPatternCategoriesConfig::class);
		$container->register( 'HandleBlockPatternCategories', fn( $container ) =>
			new HandleBlockPatternCategories( $container->get( 'BlockPatternCategoriesConfig' ) ) );

		$container->register( 'IncludedFunctionsConfig', IncludedFunctionsConfig::class);
		$container->register( 'HandleIncludedFunctions', fn( $container ) =>
			new HandleIncludedFunctions( $container->get( 'IncludedFunctionsConfig' ) ) );

		$container->register( 'BlockStylesConfig', BlockStylesConfig::class);
		$container->register( 'HandleRegisterBlockStyles', fn( $container ) =>
			new HandleRegisterBlockStyles( $container->get( 'BlockStylesConfig' ) ) );

		// Register other services that don't require configurations
		$container->register( 'HandleThemeSetup', HandleThemeSetup::class);

		// Run services
		$container->run( 'HandleAssets' );
		$container->run( 'HandlePostTypes' );
		$container->run( 'HandleTaxonomies' );
		$container->run( 'HandleThemeSetup' );
		$container->run( 'HandleRegisterBlocks' );
		$container->run( 'HandleBuildArtifacts' );
		$container->run( 'HandleBlockCategories' );
		$container->run( 'HandleIncludedFunctions' );
		$container->run( 'HandleRegisterBlockStyles' );
		// $container->run( 'HandleBlockPatternCategories' ); //@TODO: after 6.4 this seems to be broken. Investigate.
	}
}
