### Instalación 🔧

_Clonar repositorio_

```
cd c:\xampp\htdocs\>  git clone https://github.com/johannDevFull/api-invoices.git
```

_Cargar dependencias de composer_

```
composer install
```

_Crear archivo .env_

```
cp .env.example .env
```

_configure su .env_

```
Parametrizar con su informacion
```

_Generar llave para el proyecto_

```
php artisan key:generate
```

_Migrar base de datos_

```
php artisan migrate
```

_Sembrar base de datos_

```
php artisan db:seed
```
_Iniciar proyecto Laravel_

```
php artisan serve
```
