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

