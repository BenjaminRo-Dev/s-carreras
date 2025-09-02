php artisan serve --port=8080


**Ejecutar RabbitMQ**

docker run -d --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:4-management
docker run -it --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:4-management

    docker start rabbitmq
        docker logs -f rabbitmq
    docker stop rabbitmq
    docker logs rabbitmq


*Ejecutar las colas*
    php artisan queue:work                                      //Ejecuta la cola por defecto default
    php artisan queue:work rabbitmq --queue=principal           //Ejecuta la cola principal

