<?php 
namespace OSW3\Comments;

use OSW3\Comments\Utils\ConfigurationYaml;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CommentsBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        ConfigurationYaml::write($container->getParameter('kernel.project_dir'));
    }
}