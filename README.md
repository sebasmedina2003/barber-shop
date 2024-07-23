# Barber Shop - Laravel

## Generacion de usuarios
### Para generar datos iniciales de usuarios de forma automatica se deben correr los siguientes comandos despues de las migraciones
```cmd
php artisan tinker
```
```cmd
UserFactory::new()->times(15)->withProfile()->create()
```

## Generar servicios
### Dentro de tinker usar el siguiente comando
```cmd
Database\Factories\ServiceFactory::new()->times(10)->withProfile()->create()
```

## Generar Citas
### Dentro del tinker usar el siguiente comando
```cmd
Database\Factories\CitaFactory::new()->times(10)->withProfile()->create()
```