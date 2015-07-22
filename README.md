The Vagrant configuration of this Symfony based demo app ist very similar to the one in the public PHP-Schulung-Demos.git repository. Therefore please have a look at that README:

https://github.com/timon-schroeter/PHP-Schulung-Demos/blob/master/README.md

AND: Keep in mind that this machine's IP address is different to allow running both of them side by side. This machine runs on:
http://192.168.24.104/

Create the Database as follows:
app/console doctrine:schema:create

To use Sonata-Admin create yourself an admin user as follows:
app/console fos:user:create quickstart_admin
app/console fos:user:activate quickstart_admin
app/console fos:user:promote quickstart_admin
give the role: ROLE_ADMIN
