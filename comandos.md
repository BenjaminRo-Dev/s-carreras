php artisan serve --port=8080


**Ejecutar RabbitMQ**

docker run -d --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:4-management
docker run -it --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:4-management

    docker start rabbitmq
        docker logs -f rabbitmq
    docker stop rabbitmq
    docker logs rabbitmq


*Ejecutar las colas*
    php artisan queue:work                                      //Ejecuta la cola por defecto de laravel (database)
->  php artisan queue:work rabbitmq                             //Ejecuta la cola por defecto de rabbitMQ
    php artisan queue:work rabbitmq --queue=alta                //Ejecuta la cola "alta"

    php artisan queue:work rabbitmq --queue=alta,default        //Ejecuta primero la alta, luego default

    php artisan queue:retry all



*Dcoker*
    docker compose up -d --build

    Usar la terminal:
        docker compose exec app composer install
    
**Reverb**
php artisan reverb:start

Inicio rapido:

php artisan serve --port=8080
php artisan reverb:start --debug
php artisan queue:work
php artisan queue:listen

vendor/bin/sail up -d

./vendor/bin/sail artisan route:list
./vendor/bin/sail artisan queue:work

**Redis:**
    docker exec -it s-carreras-redis-1 redis-cli
    select 1
    keys * 


**Interfaces**
Redis:
    http://localhost:8081

RabbitMQ:
    http://localhost:15672

Horizon:
    sail artisan horizon
    http://localhost/horizon/