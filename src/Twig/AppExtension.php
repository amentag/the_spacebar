<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @todo documentations
     *
     * Les extension twig sont toujours instanciée à chaque requête.
     *
     * Au lieu d'injecter un service qui sera instancié à chaque requête, on impléménte l'interface ServiceSubscriberInterface.
     * Dans notre cas MarkdownHelper sera instancié seulement si on fait usage du filtre cached_markdown dans le template
     * utilisé dans la requête courante.
     * Pour cela, on injecte le ContainerInterface dans le constructeur et on définit la liste des services auxquels
     * l'extension souscrit, ici MarkdownHelper.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @todo documentations
     *
     * https://twig.symfony.com/doc/2.x/advanced.html
     * le 3eme argument nous permet ici d'appliquer un filtre |raw sur le resultat
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('cached_markdown', [$this, 'processMarkdown'], ['is_safe' => ['html']]),
        ];
    }

    public function processMarkdown($value)
    {
        return $this->container->get(MarkdownHelper::class)->parse($value);
    }

    /**
     * @todo documentations
     *
     * https://symfony.com/doc/current/service_container/service_subscribers_locators.html
     * liste des services sourscrits
     */
    public static function getSubscribedServices()
    {
        return [
            MarkdownHelper::class
        ];
    }
}
