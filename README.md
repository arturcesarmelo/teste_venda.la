# TESTE VENDA.LA 

API de produtos para para qualificação do processo seletivo venda.la

## Stack de desenvolvimento

- Lravel/Lumen-framework: 7.0
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

## Notice

No root do projeto existe o arquivo `teste-venda.la.postman_collection.json`. Trata-se da collection de recursos do postman para testar a API. Basta importá-la no postman e todos os recursos estarão lá.


## Testes

```bash
$ vendor/bin/phpunit
```