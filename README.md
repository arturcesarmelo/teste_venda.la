# TESTE VENDA.LA 

API de produtos para avaliação no processo seletivo da venda.la

## Stack de desenvolvimento

- Lavel/Lumen-framework: 7.0
- PHP 7.4
- MySQL

## Passo-a-passo para execução

```bash
# clona o repositório
$ git clone
$ cd products_api

# installar as dependências 
$ composer install

# start server
$ php -S localhost:8000 -t public
```
## Database e .env file

O arquivo `.env` segue o padrão da documentação do Lumen para configuração do bando de dados
e a o segredo da autenticação JWT.

```
APP_NAME=Lumen
APP_ENV=local
APP_KEY=4ABD7443ABADCBFA88FCD93A9F929
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=products
DB_USERNAME=homested
DB_PASSWORD=homested

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

JWT_SECRET=PBS2haEgysl93PrBUeI6Wo59LN1UxX6GccATORDfV1D0Eg48PbeQNkRVQbYFp7UI


```

Após configuração do banco de dados, basta rodar o comando `php artisan migrate` para criar as tabelas no banco.

## Postman Collection

No root do projeto existe o arquivo `teste-venda.la.postman_collection.json`. Trata-se da collection de recursos do postman para testar a API. Basta importá-la no postman e todos os recursos estarão lá.


## Testes

```bash
$ vendor/bin/phpunit
```

Best Regards!