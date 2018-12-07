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
#### Display bundle config options
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
#### Display bundle current config
```
bin/console debug:config <bundle>
```
Examples:
```
bin/console debug:config framework
bin/console debug:config twig
```
#### Create needed cache
```
bin/console cache:warmup
```
#### Debug one service in the container
```
bin/console debug:container monolog.logger
```
#### Display all services in the container by keyword
```
bin/console debug:container --show-private <keyword>
```
Examples:
```
bin/console debug:container --show-private log
```
#### Display all container parameters
```
bin/console debug:container --parameters
```