<?php 
namespace OSW3\Comments\DependencyInjection;

use Symfony\Component\Filesystem\Path;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use OSW3\Comments\DependencyInjection\DefinitionConfigurator;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
	/**
	 * define the name of the configuration tree.
	 * > /config/packages/comments.yaml
	 *
	 * @var string
	 */
	public const string NAME = "comments";

	/**
	 * Define the translation domain
	 *
	 * @var string
	 */
	public const string DOMAIN = 'comments';

	/**
	 * Update and return the Configuration Builder
	 *
	 * @return TreeBuilder
	 */
	public function getConfigTreeBuilder(): TreeBuilder
    {
        $definition = require Path::join(__DIR__, "../../", "config/definition/definition.php");
        $builder    = new TreeBuilder( static::NAME );

        $definition(new DefinitionConfigurator($builder->getRootNode()));

		return $builder;
    }
}