FROM phpdockerio/php73-fpm

RUN apt-get update

RUN apt-get install -y openssl vim libssl-dev wget git php-pear

RUN apt-get install -y php-dev php7.3-mysql php-xdebug php-yaml php7.3-gd

RUN pecl install swoole && \
    touch /etc/php/7.3/mods-available/swoole.ini && \
    echo 'extension=swoole.so' > /etc/php/7.3/mods-available/swoole.ini

RUN pecl install inotify && \
    touch /etc/php/7.3/mods-available/inotify.ini && \
    echo 'extension=inotify.so' > /etc/php/7.3/mods-available/inotify.ini

RUN echo 'extension=inotify.so' >> /etc/php/7.3/cli/php.ini && \
    echo 'extension=swoole.so' >> /etc/php/7.3/cli/php.ini

EXPOSE 9500
#CMD ["/application/bin/console", "swoole:server:run"]