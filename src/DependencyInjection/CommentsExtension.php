<?php 
namespace OSW3\Comments\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use OSW3\Comments\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Filesystem\Path;

class CommentsExtension extends Extension implements PrependExtensionInterface 
{
	/**
	 * Bundle configuration Injection
	 *
	 * @param array $configs
	 * @param ContainerBuilder $container
	 *
	 * @return void
	 */
	public function load(array $configs, ContainerBuilder $container)
    {
		// Default Config
		// --
		
		$config = $this->processConfiguration(new Configuration(), $configs);
		$container->setParameter($this->getAlias(), $config);		
        

		// Bundle config location
		// --
		
		$locator = new FileLocator(Path::join(__DIR__, "/../../", "config"));
		$loader = new YamlFileLoader($container, $locator);
		

		// Services Injection
		// --
		
		$loader->load('services.yaml');
    }

	/**
	 * Prepend some data to the global app configuration
	 *
	 * @param ContainerBuilder $container
	 *
	 * @return void
	 */
	public function prepend(ContainerBuilder $container)
    {
        // Extend Twig configuration
        // --

        $twigConfig = [];

		// Expose the templates directory
		$templateDirectoryPath = Path::join(__DIR__, "/../../", "templates");

		if (is_dir($templateDirectoryPath))
		{
			$twigConfig['paths'][$templateDirectoryPath] = "Comments";
		}

        $container->prependExtensionConfig('twig', $twigConfig);
    }
}