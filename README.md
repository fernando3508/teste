<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Processo de seleção utilizando framework Yii 2</h1>
    <br>
</p>

Pequeno Sistema de cadastro de clientes, produtos e pedidos utilizando framework Yii2 e Mysql

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

O requisito mínimo por este modelo de projeto que o seu servidor da Web suporta PHP 5.4.0.

INSTALLATION
------------

### Install via git

~~~
git clone https://github.com/fernando3508/teste.git

composer install
~~~

CONFIGURATION
-------------

### Database

Edite o arquivo `config / db.php`, por exemplo:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=atividade',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTE:**
- O Yii não criará o banco de dados para você, isso deve ser feito manualmente antes que você possa acessá-lo.
- Verifique e edite os outros arquivos no diretório `config /` para customizar seu aplicativo conforme necessário.

### Migration

Na pasta principal utilizer o seguinte comando:

~~~
php yii migrate
~~~

Ou

~~~
./yii migrate
~~~

Testando
-------

Após a instalação ser concluída, você pode tanto configurar seu servidor web como usar o servidor web embutido do PHP executando o seguinte comando de console no diretório web:

```
php yii serve
```

**NOTE:**
Por padrão o servidor HTTP vai ouvir na porta 8080. Contudo, se preferir troca a porta você pode especificar uma nova porta para se usada com o argumento --port:

```
php yii serve --port=8888
```

Você pode usar seu navegador para acessar a aplicação instalada por meio da seguinte URL:

```
http://localhost:8080/
```

