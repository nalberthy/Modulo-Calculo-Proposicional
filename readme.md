<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Instalar depedências

Após a clonagem do projeto é necessário instalar algumas depedências para rodar o projeto, confira abaixo o passo a passo para instalação das dependencias.

### Clonar projeto
 - git clone git@github.com:seuprojeto

### Acesse o projeto
 - cd 'seu_projeto'

### Instalar dependências e o framwork 
 - composer install --no-scripts

### Copiar arquivos necessários
 Caso não tenha os arquivos ".env.example" e ".env" no projeto, você deverar copiar estes arquivos de outro projeto existente. Caso não tenha um projeto laravel existente em sua maquina, crie um novo projeto usando (composer create-project --prefer-dist laravel/laravel nomeprojeto). obs: após a criação dos arquivos citados a cima pode-se cancelar a criação do novo projeto.

### Criar uma nova chave para a aplicação
 - php artisan key:generate
