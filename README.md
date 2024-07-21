# Barber Shop - Laravel

## Generacion de usuarios
### Para generar datos iniciales de usuarios de forma automatica se deben correr los siguientes comandos despues de las migraciones
```cmd
php artisan tinker
```
```cmd
UserFactory::new()->times(4)->withProfile()->create()
```