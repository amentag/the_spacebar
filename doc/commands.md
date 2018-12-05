#### Run php internal server
```
bin/console server:run
```
#### Generate controller
```
bin/console make:controller
```
#### List routes
```
bin/console debug:router
```
#### List services
```
bin/console debug:autowiring
```
#### Display bundle config
```
bin/console config:dump <bundle>
```
Examples:
```
bin/console config:dump twig
bin/console config:dump framework
bin/console config:dump monolog
bin/console config:dump KnpMarkdownBundle
```
#### Clear cache
```
bin/console cache:clear
```
#### Display all services in the container
```
bin/console debug:container --show-private
```