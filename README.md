[![issues](https://img.shields.io/github/issues/luizcsbh/api-credito)](https://github.com/luizcsbh/api-credito/issues)
![forks](https://img.shields.io/github/forks/luizcsbh/api-credito)
![stars](https://img.shields.io/github/stars/luizcsbh/api-credito)
![code-size](https://img.shields.io/github/languages/code-size/luizcsbh/api-credito)
[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/luizcsbh/api-credito/laravel-ci.yml)](https://github.com/luizcsbh/api-credito/actions)
[![commit activity](https://img.shields.io/github/commit-activity/m/luizcsbh/api-credito)](https://github.com/luizcsbh/api-credito/commits)
[![last commit](https://img.shields.io/github/last-commit/luizcsbh/api-credito)](https://github.com/luizcsbh/api-credito/commits)

[![twwiter follow](https://img.shields.io/twitter/follow/luizcs?style=social)](https://twitter.com/luizcs)


![API-Crédito](https://github.com/luizcsbh/api-credito/raw/main/assets/api-credito.png)

## Projeto API-CREDITO

API que simula ofertas de crédito para clientes cadastrados no banco usando framework Laravel no backend e documentação com swagger

### Configuracao do Projeto

Para rodar o projeto localmente será necessário configura o banco de dados no .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simulacao
DB_USERNAME=root
DB_PASSWORD=
```
Configuração do Cache
```env
CACHE_DRIVER=redis
```

Após de configuração do Projeto rode o comando abaixo para povoar o banco de dados

```php
php artisan db:seed
```
## Documentação
A API está documenta usando swagger na local

http://127.0.0.1:8000/api/documentation

url 

https://api-credito.up.railway.app/api/documentation

Para acessar a simulação  de credito acesse a url
http://127.0.0.1:8000/api/simulacao/credito


Para acessar a simulação  de ofetas de credito acesse a url
http://127.0.0.1:8000/api/simulacao/simula-oferta

## Segurança e vulnerabilidades

Se você descobrir uma brecha de segurança e ou vulnerabilidade neste projeto, por favor envie um e-mail para Luiz Santos via [luizcsdev@gmail.com](mailto:luizcsdev@gmail.com). 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://github.com/luizcsbh/api-credito/blob/main/LICENSE).
