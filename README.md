Prueba de código backend - Senior
Una cadena hotelera dispone de un servicio web que devuelve el listado de alojados en sus hoteles para que
sea integrado por STAY. La url del servicio es la siguiente:
https://cluster-dev.stay-app.com/int/pms-faker/stay/test/pms
Este servicio funciona mediante el método GET y recibe un parámetro ts con el que se le puede indicar un
timestamp (en formato estándar unix y con precisión de segundos) para obtener las reservas generadas a
partir de cierto instante. Dicho parámetro es obligatorio. Por ejemplo:
ts=0 Devuelve la totalidad de reservas activas
ts=1643277600 Devuelve la totalidad de las reservas activas que hayan hecho

check-in a partir del 27/01/2022 a las 10:00:00 AM

El servicio devuelve un JSON con dos campos:
● Un campo total que contiene un entero con el número de reservas devueltas
● Un campo bookings que contiene un array de objetos con el siguiente formato:

Se consume las estancias en mediante ficheros CSV con el siguiente formato:
● Localizador de la estancia (columna 0)
● Nombre del cliente (columna 1)
● Apellido del cliente (columna 2)
● Pasaporte del cliente (columna 3)
● Fecha de nacimiento (columna 4)
● Código ISO de 2 letras del país de residencia (columna 5)
● Código del hotel (columna 6)
● Fecha de entrada al hotel (columna 7)
● Fecha de salida del hotel (columna 8)
● Número de habitación (columna 9)
Se necesita un servicio web (desarrollado en PHP o Node.js) que al ser llamado procese la llamada al servicio
web del hotel, transforme la información recibida y devuelva un fichero CSV en el formato que necesita STAY.
El servicio debe poder ejecutarse varias veces consecutivas y en cada ejecución generará un fichero que
contendrá sólo las estancias que hayan hecho check-in desde la última petición que haya hecho el
consumidor. Si no hay estancias nuevas, deberá devolver un fichero vacío.
A tener en cuenta
● El servicio web del hotel genera estancias ficticias para los hoteles con código "36001", "28001",
"28003", "49001". En cada llamada, el número de nuevas estancias creadas de los hoteles es aleatorio
(entre 1 y 5 habitaciones por hotel en cada llamada). Entre una llamada y la siguiente las estancias no
se repiten.
● El servicio web del hotel generará, como mucho, 200 estancias activas en cada hotel. Si tras N
llamadas realizadas el hotel se llena el endpoint no generará nuevas estancias activas de ese hotel. Si
todos los hoteles se llenan, se devolverá un array vacío hasta que alguna entre en checkout.
● En el caso de usar PHP se deberá usar la sintaxis de la versión 7.4
● En el caso de usar NodeJS se deberá usar la versión 14 (si se utiliza Typescript en lugar de Javascript
usar sintaxis de Typescript 4)
● Para facilitar el desarrollo se considera que sólo existirá un único consumidor del servicio y que las
llamadas no se harán concurrentes, es decir, el consumidor esperará a obtener un fichero CSV para
solicitar el siguiente.
● Se podrá estructurar el código como se quiera, no hay límite en el número de clases a usar ya que con
la prueba se quiere ver la capacidad de estructuración del código del candidato
● Se puede utilizar el framework o librerías auxiliares que se consideren necesarias para resolver la
prueba. También está permitido el uso de gestores de dependencias.
● Se deberán entregar instrucciones de cómo ejecutar el servicio, su ruta y/o todo aquello que se
considere necesario.

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
