<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.cultura.gob.sv/wp-content/uploads/2021/06/MinisterioCultura.png" width="400"></a></p>

# MC Framework

Proyecto de desarrollo base para el Ministerio de Cultura

## Características disponibles

-   Autenticación por JWT
-   Backups automáticos en el servidor y en una cuenta de OneDrive
-   Encriptación de valores
-   Componentes pre-fabricados
-   Log automático de las peticiones realizadas al servidor
-   Autenticación por LoginSV
-   Línea gráfica del GOES
-   Límite de peticiones hacia el servidor de 75 peticiones/min
-   Exportación de usuarios registrados a un CSV
-   Traducido al español

## Módulos disponibles

-   Administración de usuarios
-   Administración de departamentos
-   Administración de Municipios

## Instalación

### Descargar el proyecto

        git clone https://github.com/leolopezMC/base-app-mc

### Instalar las dependencias

        composer install

        npm install

### Archivo de configuración

Copiar y pegar el archivo de configuración de ejemplo `.env.example` y renombrando la copia como `.env`

        cp .env.example .env

Generar la llave única de la aplicación

        php artisan key:generate

Generar la llave única para JWT

        php artisan jwt:secret

(OPCIONAL) Para obtener la documentación completa dentro del IDE

        php artisan ide-helper:generate       

### Crear la base de datos

Crear la base de datos dentro del gestor utilizado, con el nombre indicado en el archivo de configuración `.env` en la variable de entorno `DB_DATABASE`

### Correr las migraciones

        php artisan migrate:fresh --seed

### Iniciar el proyecto

        php artisan serve

        npm run hot
