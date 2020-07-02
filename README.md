# **Exercise Zemoga**

#### Technologies Used
- Framework Symfony 5.1
- Language PHP
- DB Mysql

#### Requirements
- PHP 7.2.5 or higher and these PHP extensions (which are installed and enabled by default in most PHP 7 installations): Ctype, iconv, JSON, PCRE, Session, SimpleXML, and Tokenizer;
- MySql 5.7
- Composer
- yarn

### Installation
##### Config Data Base
- Copy **.env.local.dist** paste with name **.env** and set connection data how user, password, url and name DB
- For creation Data Base **RUN** `php bin/console doctrine:database:create`
- For creation tables **RUN** `php bin/console doctrine:migrations:migrate`
- Create initial data **RUN** `php bin/console app:fill-data-base`
- Information about Model and Schema database, search in route `proyect/DB/*`

##### Config App
- Go to config a Virtual Host according documentation symfony [Configuring a Web Server](https://symfony.com/doc/current/setup/web_server_configuration.html)
- Compile assets, running `yarn install && yarn encore dev` or app set config prod `yarn install && yarn encore production`

I finished the test around 16 Hours.

#### Get data anything profile
The route for access is `/api/portfolio/profile/twitterName` for example `/api/portfolio/profile/rslj_25`

#### Examples initial data
- `/api/portfolio/profile/GoT_Tyrion`
- `/api/portfolio/profile/Daenerys`
- `/api/portfolio/profile/LordSnow`
- `/api/portfolio/profile/Lady_Sansa`
- `/api/portfolio/profile/GameOfThrones`