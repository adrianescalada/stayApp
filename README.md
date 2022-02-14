# Docker

docker-compose up

# Instalacion

1. composer update
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate
5. php artisan db:seed

composer dumpautoload -o

# console

Devuelve la totalidad de reservas activas (ts=0)

-   php artisan send:stay

La opción --tsToday Devuelve las reservas del dia actual

-   php artisan send:stay --tsToday

La opción --tsDay --tsHour Devuelve las reservas del dia y hora indicados

-   php artisan send:stay --tsDay=10/02/2022 --tsHour=10:00

La opción --truncate vacía los datos de booking guardados

-   php artisan send:stay --truncate --tsDay=10/02/2022 --tsHour=10:00

Nota: Se pueden combinar las distintas opciones antes descriptas
