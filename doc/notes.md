##### unpack recipe package
```
composer unpack <recipe> 
```
example
```
composer unpack debug
```
the recipe package is unpacked and it can be possible to remove on library of the package or change its version
##### following
1. creating a custom log file
1. autowire custom logger service
    - il est impossible pour l'autowiring par defaut de choisir le custom logger. Il faudra donc definir les paramètres de la classe implémentant le custom logger.
1. since symfony 4.2, we can autowire more than services class, like boolean, string ...
1. in twig extension, to apply by default "|raw" filter, add third argument like the following example:
```php
class AppExtension extends AbstractExtension
{
    /**
     * @var MarkdownHelper
     */
    private $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    public function getFilters(): array
    {
        // look at the last argument, ['is_safe' => ['html']], to apply |raw for html code after cached_markdown filter
        return [
            new TwigFilter('cached_markdown', [$this, 'processMarkdown'], ['is_safe' => ['html']]),
        ];
    }

    public function processMarkdown($value)
    {
        return $this->markdownHelper->parse($value);
    }
}
```
