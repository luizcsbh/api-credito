
## Projeto API-CREDITO

API que simula ofertas de crédito para clientes cadastrados no banco usando framework Laravel no backend e documentação com swagger

### Configuracao do Projeto

Para rodar o projeto é necessário configura o banco de dados no .env
``env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simulacao
DB_USERNAME=root
DB_PASSWORD=
``
Após de configuração do Projeto rode o comando abaixo para povoar o banco de dados

```php
php artisan db:seed
```
## Documentação
A API está documenta usando swagger na 

http://127.0.0.1:8000/api/documentation

Para acessar a simulação  de credito acesse a url
http://127.0.0.1:8000/api/simulacao/credito


Para acessar a simulação  de ofetas de credito acesse a url
http://127.0.0.1:8000/api/simulacao/simula-oferta

## Segurança e vulnerabilidades

Se você descobrir uma brecha de segurança e ou vulnerabilidade neste projeto, por favor envie um e-mail para Luiz Santos via [luizcsdev@gmail.com](mailto:luizcsdev@gmail.com). 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
