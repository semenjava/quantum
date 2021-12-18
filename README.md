# Quantum EAP

## Local Development Environment Setup

- `composer install`
- run `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`
- add the same command to your .bashrc /.zshrc / etc.
- `sail up -d`

and the project will start installing the docker system.

Once done:
- `sail artisan key:generate`
 
The dev server now runs at http://localhost:8084/

For more information read the sail documentation: https://laravel.com/docs/8.x/sail

### Basic commands for working with sail

- `sail artisan <name_command>`
- `sail composer <name_command>`

### Frontend commands

- `npm run dev`
- `npm run lint`
- `npm run build`

### Generate and use GraphQL scheme
- `sail artisan lighthouse:print-schema --write`
- Fill `.env` from `.env.example` from the root of the project. 
- PHPStorm GraphQL plugin: https://plugins.jetbrains.com/plugin/8097-graphql
- Plugin is using settings from `.graphqlconfig` 

### How to run PHP CS Fixer inside Docker

- Log inside laravel docker container: 

`docker exec -it quantum_laravel bash`

- Install php-cs-fixer inside **tools/php-cs-fixer** folder:

`cd tools/php-cs-fixer && composer install`

- Now you can run php lint:

`./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix -vvv --dry-run --config=tools/php-cs-fixer/.php-cs-fixer.dist.php`

- Omit `--dry-run` key to fix files automatically

`./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix -vvv --config=tools/php-cs-fixer/.php-cs-fixer.dist.php`

### Hot to setup PhpStorm

#### Set up ESLint
Settings → Languages & Frameworks → JavaScript → Code Quality Tools → ESLint

- [x] Automatic ESLint configuration
- [x] Optional: Run eslint --fix on save

#### Set up PHP CS Fixer
PHP → Quality Tools → PHP CS Fixer

- Create new configuration.
- Choose your project docker container as CLI Interpreter (laravel.test service).
- PHP CS Fixer path: `/var/www/html/tools/php-cs-fixer/vendor/bin/php-cs-fixer`
- Press Validate to check

Editor → Inspections → Quality tools → PHP CS Fixer validation

- Ruleset: Custom
- Path: `/var/www/html/tools/php-cs-fixer/.php-cs-fixer.dist.php`
- Optional: Choose Error severity in All Scopes
