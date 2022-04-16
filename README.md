<center><img src="https://www.cultura.gob.sv/wp-content/uploads/2021/06/MinisterioCultura.png" width="200px" height="200px"></img></center>

# MC Framework

Proyecto base para el Ministerio de Cultura

## Características disponibles

-   Autenticación por JWT
-   Backups automáticos en el servidor y en una cuenta de OneDrive
-   Línea gráfica del GOES
-   Traducido al español
-   Límite de peticiones hacia el servidor de 75 peticiones/min
-   Encriptación de valores
-   Autenticación por LoginSV
-   Exportación de usuarios registrados a un CSV

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

Generar la llave única

        php artisan key:generate

### Crear la base de datos

Crear la base de datos dentro del gestor utilizado, con el nombre indicado en el archivo de configuración `.env` en la variable de entorno `DB_DATABASE`

### Correr las migraciones

        php artisan migrate:fresh --seed

### Iniciar el proyecto

        php artisan serve

        npm run hot
