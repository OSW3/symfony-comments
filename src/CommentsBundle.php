<?php 
namespace OSW3\Comments;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use OSW3\Comments\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CommentsBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        (new Configuration)->generateProjectConfig($container->getParameter('kernel.project_dir'));
    }
}