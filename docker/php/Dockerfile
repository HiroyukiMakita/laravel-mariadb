ARG PHP_IMAGE_VERSION
FROM php:${PHP_IMAGE_VERSION}

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH ${PATH}:/composer/vendor/bin
ENV LANG C.UTF-8
ENV LANGUAGE en_US:

ARG XDEBUG_VERSION
ARG NODE_VERSION
ARG NPM_VERSION

# apt-getでインストールするのはOS用のパッケージ
# peclでインストールするのはPHP用のパッケージ

# インストール可能なパッケージの「一覧」を更新
RUN apt-get update \
  # node インストール
  && curl -sL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
  && apt-get install -y nodejs git vim screen \
  && npm install -g npm@${NPM_VERSION} \
  && pecl install xdebug${XDEBUG_VERSION} \
  && docker-php-ext-enable xdebug \
  && docker-php-ext-install pdo_mysql \
  # composer
  # https://getcomposer.org/download/
  # インストーラーを現在のディレクトリにダウンロード
  && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  # インストーラーSHA-384を確認
  && php -r "if (hash_file('sha384', 'composer-setup.php') === trim(file_get_contents('https://composer.github.io/installer.sig'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  # インストーラーを実行
  && php composer-setup.php \
  # インストーラーを削除
  && php -r "unlink('composer-setup.php');" \
  # グローバルに配置
  && mv composer.phar /usr/local/bin/composer \
  # Laravel のインストーラをダウンロード
  && composer global require laravel/installer \
  # Clear cache
  # apt-get clean では /var/cache/apt/archives にキャッシュされている全てのパッケージを削除
  # rm -rf /var/lib/apt/lists/* では /var/cache/apt/list にキャッシュされている全てのパッケージリストを削除
  && apt-get clean && rm -rf /var/lib/apt/lists/*
