FROM debian:jessie

RUN apt-get update -qq && apt-get install -qqy apt-utils curl python-setuptools ca-certificates --no-install-recommends \
    && curl -fSL -m 10 https://www.dotdeb.org/dotdeb.gpg | apt-key add - \
    && echo "deb http://ftp.hosteurope.de/mirror/packages.dotdeb.org/ stable all" > /etc/apt/sources.list.d/php7.list \
    && echo "deb-src http://ftp.hosteurope.de/mirror/packages.dotdeb.org/ stable all" >> /etc/apt/sources.list.d/php7.list \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -yqq \
        php7.0 \
        php7.0-cli \
        php7.0-fpm \
        php7.0-common \
        php7.0-gd \
        php7.0-curl \
        php7.0-enchant \
        php7.0-fpm \
        php7.0-intl \
        php7.0-json \
        php7.0-ldap \
        php7.0-mcrypt \
        php7.0-mysql \
        php7.0-odbc \
        php7.0-pgsql \
        php7.0-phpdbg \
        php7.0-readline \
        php7.0-sqlite3 \
        php7.0-sybase \
        php7.0-tidy \
        php7.0-xmlrpc \
        php7.0-xsl \
        php7.0-memcached \
        php7.0-imagick \
        php7.0-mongodb \
        php7.0-mbstring \
        php7.0-bcmath \
        php7.0-xdebug \
        php7.0-zip \
    && apt-get install curl git -yqq \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony \
    && chmod a+x /usr/local/bin/symfony \
    && apt-get purge apt-utils python-setuptools -yqq \
    && rm -rf /var/lib/apt/lists/*

RUN usermod -u 1000 www-data

WORKDIR /data/app