# seventh-desafio-backend
Projeto backend do desafio da empresa Seventh

## Visão Geral

O desafio foi cumprido com as camadas de backend e frontend isoladas, para isso foram criados dois repositórios para os projetos distintos.

- [seventh-desafio-backend | PHP Laravel](https://github.com/robmoraes/seventh-desafio-backend)
- [seventh-desafio-frontend | Vue.js/Quasar.dev](https://github.com/robmoraes/seventh-desafio-frontend)

Esse repositório contém a camada de backend da aplicação que não utiliza nenhum recurso de frontend. Abaixo seguem as instruções para instalação.

## Requisitos do Servidor

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- SQLite3
- SQLite3 PHP Extension

### Composer

Laravel utiliza [Composer](https://getcomposer.org/) para gerenciar as dependências do projeto. Então, antes de começar a instação do projeto é necessária a instalação do Composer no servidor.

[Laravel 7.x requirements](https://laravel.com/docs/7.x/installation#server-requirements)

Foi usado no desenvolvimento:

- LINUX (não faço ideia se funciona corretamente instalando no windows, provavelmente sim)
- PHP 7.3.27-9+ubuntu18.04.1+deb.sury.org+1
- Laravel 7.24
- Apache2

## Instalação

No servidor web que será usado para demonstração, realizar download:

```bash
$ git clone https://github.com/robmoraes/seventh-desafio-backend.git
```

Após conclusão do clone do repositório, é necessário instalar as dependências com composer:

```bash
$ cd /pasta/do/projeto/
$ composer install
```

Agora é necessário renomear o arquivo ".env.example" para ".env" e ajustar a variável de ambiente APP_URL para a url onde rodará essa demonstração:

- APP_URL=localhost:8000  # por exemplo

### Banco de dados

O banco de dados será baixado em "/database/database.sqlite". Para criar a estrutura e carregar os dados inciais de acesso execute:

```bash
$ cd /pasta/do/projeto/
$ php artisan migrate:fresh --seed
```

Após a migração, o sistema de ACL será configurado criando e atribuindo as permissões(permissions) à dois Perfis(roles): (Admin, Cliente), e um usuário será criado com o perfil Admin para permitir o acesso inicial ao sistema.

- Email/login: desafio@seventh.com.br
- Senha: 12345678
- Perfil/Role: Admin

Com o banco de dados migrado, agora é necessário configurar um "Password Grant Client" para acesso aos recurso do Oauth de geração de tokens de acesso para os usuários consumidores da API.

```bash
$ cd /pasta/do/projeto/
$ php artisan passport:client --password
```

Confirme as duas perguntas seguintes com ENTER para usar o valor padrão de ambas:

```bash
What should we name the password grant client? [Desafio Seventh Password Grant Client]:

Which user provider should this client use to retrieve users? [users]:
  [0] users

Password grant client created successfully.
Client ID: 92ea8f45-322f-4911-82b5-65915e92ccfc
Client secret: qP5wZHL3u7OsLQfhRjXI96srLP2gd86h4relha5P
```

Os códigos gerados "Client Id" e "Client secret" devem ser copiados para o arquivo .env preenchendo respectivamente as variáveis de ambiente que estão no fim do arquivo:

- PASSPORT_PERSONAL_ACCESS_CLIENT_ID=
- PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=

## Pronto

O projeto de backend está configurado e pronto para rodar. Será necessário configurar um site no Apache2, ou httpd expondo a pasta "/public" para rodar a aplicação.

Mas como o processo de instalação é relativamente longo, preparei um ambiente de degustação para que possam avaliar. Para isso, publiquei o build do frontend na estrutura de views do laravel e fiz um pequeno ajuste nas rotas do laravel (/routes/web.php) para resolver as uris do front. Sendo assim a API e o Front rodam sob mesmo domínio, mas a construção foi completamente desacoplada.

- [Playground do desafio](https://api.seventh.seemann.com.br)

Lembrando:

- e-mail: desafio@seventh.com.br
- senha: 12345678

## API

Não houve tempo para configurar o Swagger com documentação da API, então preparei uma página na Wiki com uma breve descrição dos endpoints.

- [github.com/robmoraes/seventh-desafio-backend/wiki/API](https://github.com/robmoraes/seventh-desafio-backend/wiki/API)

Ainda na Wiki, também comentei alguns pontos notáveis do projeto.

- [github.com/robmoraes/seventh-desafio-backend/wiki](https://github.com/robmoraes/seventh-desafio-backend/wiki)