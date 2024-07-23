<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notificación de Estado de Cita</title>
</head>
<body>
    <h1>Notificación de Estado de Cita</h1>
    
    <p>Estimado(a) {{ $client_name }},</p>
    
    <p>Le informamos que el estado de su cita programada para el {{ $fecha_cita }} ha sido actualizado.</p>
    
    <p>Nuevo estado de la cita: {{ $estado_cita }}</p>
    
    <p>Por favor, no dude en contactarnos si tiene alguna pregunta o necesita más información.</p>
    
    <p>Atentamente,</p>
    <p>El equipo de Barber Shop</p>
</body>
</html>