## Prepare
Make sure that your local system is properly configured for Symfony.
1. Execute the `check.php` script from the command line:
    php app/check.php
2. Access the `config.php` script from a browser:
    http://localhost/path/to/symfony/app/web/config.php
If you get any warnings or recommendations, fix them before moving on.

## Install
1. Copy app\config\parameters.yml.dist to app\config\parameters.yml and edit it to reflect your own database and SMTP server configuration.
2. Execute `php app/console doctrine:schema:update --force` to create the database structure. 

## Setup
You can log in as admin and create users and groups via the Sonata User functionality (which integrates FOS User and Sonata Admin). To be able to do that, proceed as follows:
1. php app/console fos:user:create quickstart_admin
2. php app/console fos:user:activate quickstart_admin
3. php app/console fos:user:promote quickstart_admin
    and enter the role: ROLE_ADMIN
4. Open web/app_dev.php/admin/dashboard and click "Add user" and "Add Group" as desired.

## Test
1. This app includes functional tests for the integration of FOS User, Sonata Admin and Sonata User. Run them as follows:
    phpunit -c app/phpunit.xml.dist

## Explore
The included FOS-User, Sonata Admin and Sonata User bundles provide great functionalty. It's all integrated, configured and ready for you to explore.
1. Run "php app/console router:debug" and check out the many routes starting with "fos_user...", "sonata_admin" and "sonata_user".

## Update
1. Be careful: The composer.json file uses the dev-master version of  FOS-User, Sonata Admin and Sonata User. Use "composer.phar update PackageToUpdate" to update (install) only one specific package. Run Functional tests before and after updates.
