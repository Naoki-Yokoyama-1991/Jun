FROM php:7.4-fpm
WORKDIR /var/www/html
RUN apt-get update -qq \
  && apt-get install -y \
  ruby \
  ruby-dev \
  rubygems \
  libsqlite3-dev \
  && apt-get autoremove \
  && apt-get clean
RUN gem install mailcatcher
COPY ./php/php.ini /usr/local/etc/php/
