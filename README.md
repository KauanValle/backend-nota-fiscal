
# Setup Docker Laravel 10 com PHP 8.1
Creditos do projeto laravel com docker: Especializa TI

### Passo a passo
```sh
cd backend-nota-fiscal
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

AUTHORIZATION_API_TOKEN="F52627B4F08D09E5CE65B810AA57925E"
API_URL_VERACIDADE="http://localhost:3000" (Caso não funcione com localhost, pegue o IPv4 e coloque antes da porta).
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse o projeto
[http://localhost:8989](http://localhost:8989)
