# **Exercise Zemoga**

#### Requirements
- PHP 7.2.5 or higher and these PHP extensions (which are installed and enabled by default in most PHP 7 installations): Ctype, iconv, JSON, PCRE, Session, SimpleXML, and Tokenizer;
- MySql 5.7
- Composer
- yarn

### Installation
##### Config Data Base
- Copy **.env.local.dist** paste with name **.env** and set connection data how user, password, url and name DB
- For creation Base Data **RUN** `php bin/console doctrine:database:create`
- For creation tables **RUN** `php bin/console doctrine:migrations:migrate`

##### Config App
- Go to config a Virtual Host according documentation symfony [Configuring a Web Server](https://symfony.com/doc/current/setup/web_server_configuration.html)
- Compile assets, running `yarn install && yarn encore dev` or app set config prod `yarn install && yarn encore production`
- Run `php bin/console app:fill-data-base` for fill initial data