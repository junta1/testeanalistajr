# Gereciamento de clientes - Desafio
Uma empresa de distribuição de alimentos precisa de um sistema interno para gerenciar seus clientes e endereços de entrega.

## Baixando projeto

`git clone https://github.com/junta1/testeanalistajr.git`

## Levantar o Container

Acesse ao projeto e lavante o container: 

`docker-compose up -d`

Acesse ao container: 

`docker exec -it analistaJr-php bash`

_Obs: Configure o projeto nos próximos passos._ 

## Configurando projeto

Depedências via composer:

`composer install`

Depedências via nodejs:

`npm install && npm run dev`


Altere as permissões:

`chmod -R 777 storage/ bootstrap/`

Copiar e colar o arquivo .env.example 
situado em (testeanalistajr/www/.env.example) para .env no mesmo local ou executar o comando:

`cp .env.example  .env`

Defina a chave da aplicação:

`php artisan key:generate`

Gere as migrations com as seeds:

`php artisan migrate:refresh --seed`

Link para acessar a página inicial do projeto: <http://localhost:8888>

***Acesse com o usuário e senha:***

Usuário: admin@gmail.com

Senha: 12345678
