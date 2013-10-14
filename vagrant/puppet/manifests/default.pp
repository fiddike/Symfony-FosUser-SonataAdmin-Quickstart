Exec {
    path => "/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin"
}

exec { "apt-update":
    command => "apt-get update"
}

Exec["apt-update"] -> Package <| |>

# Install cURL
package { "curl":
    ensure => installed,
}

# Install VIM
package { "vim":
    ensure => installed,
}

# Install Screen
package { "screen":
    ensure => installed,
}

# Install MySQL server
package { "mysql-server":
    ensure => installed,
}

service { "mysql":
    ensure => running,
    require => Package["mysql-server"],
}

# Install nginx
package { "nginx":
    ensure => installed,
}

service { "nginx":
    ensure => running,
    require => Package["nginx"],
}

# Install PHP
package { "php5-cli":
    ensure => installed,
}

package { "php5-fpm":
    ensure => installed,
}

service { "php5-fpm":
    ensure => running,
    require => Package["php5-fpm"],
}

# Install SQLite
package { "sqlite3":
    ensure => installed,
}

# Install PHP packages
package { [
    "php-apc",
    "php-pear",
    "php5-intl",
    "php5-mysql",
    "php5-xdebug",
]:
    ensure => installed,
    require => [Package["php5-cli"], Package["php5-fpm"]],
    notify => Service["php5-fpm"],
}

# Configure xdebug
file { "/etc/php5/conf.d/xdebug.ini":
    ensure => file,
    source => "/tmp/vagrant-puppet/manifests/xdebug",
    require => [Package["php5-cli"], Package["php5-fpm"]],
    notify => Service["php5-fpm"],
}

# Configure PHP-FPM
exec { "update-fpm-user":
    command => "sudo sed -i 's/user = www-data/user = vagrant/' /etc/php5/fpm/pool.d/www.conf",
    require => Package["php5-fpm"],
    notify => Service["php5-fpm"],
}

exec { "display-php-errors":
    command => 'sudo sed "s/^display_errors = Off/display_errors = On/" -i /etc/php5/fpm/php.ini',
    require => Package["php5-fpm"],
    notify => Service["php5-fpm"],
}

exec { "display-php-startup-errors":
    command => 'sudo sed "s/^display_startup_errors = Off/display_startup_errors = On/" -i /etc/php5/fpm/php.ini',
    require => Package["php5-fpm"],
    notify => Service["php5-fpm"],
}

exec { "php-timezone-cli":
    command => 'sudo sed "s/^;date.timezone =/date.timezone = Europe\/Berlin/" -i /etc/php5/cli/php.ini',
    require => Package["php5-cli"],
}

exec { "php-timezone-fpm":
    command => 'sudo sed "s/^;date.timezone =/date.timezone = Europe\/Berlin/" -i /etc/php5/fpm/php.ini',
    require => Package["php5-fpm"],
    notify => Service["php5-fpm"],
}

# Setup demo webserver
file { "/etc/nginx/sites-enabled/php-schulung-demos.conf":
    path => "/etc/nginx/sites-enabled/php-schulung-demos.conf",
    ensure => present,
    source => "/tmp/vagrant-puppet/manifests/nginx",
    notify => Service["nginx"],
    require => Package["nginx"],
}

file { "/etc/nginx/sites-enabled/default":
    ensure => absent,
}

exec { "mysql":
    command => "mysql -u root -e 'CREATE DATABASE IF NOT EXISTS `php-schulung-demos`;'",
    require => Service["mysql"],
}

exec { "mysql-access":
    command => "mysql -u root -e 'GRANT ALL PRIVILEGES ON *.* TO `root`@`%` WITH GRANT OPTION; FLUSH PRIVILEGES;'",
    require => Service["mysql"],
}

exec { "remote-access":
    command => 'sed "s/bind-address/#bind-address/" -i /etc/mysql/my.cnf',
    require => Package["mysql-server"],
    notify => Service["mysql"],
}

# Install varnish
package { "varnish":
    ensure => installed,
}

service { "varnish":
    ensure => running,
    require => Package["varnish"],
}

exec { "varnish-on-default-high-port":
    command => 'sudo sed "s/.port = \"8080\";/.port = \"80\";/" -i /etc/varnish/default.vcl',
    require => Package["varnish"],
    notify => Service["varnish"],
}