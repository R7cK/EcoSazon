<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a EcoSazón</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2 style="color: #28a745;">¡Hola, {{ $user->name }}!</h2>
    <p>Gracias por unirte a la red de EcoSazón. Tu registro se ha completado con éxito.</p>
    <p>Ahora puedes acceder a nuestra plataforma para explorar las mejores cocinas económicas de Mérida.</p>
    <br>
    <a href="{{ route('login') }}" 
       style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
       Ir al Login
    </a>
    <br><br>
    <p>Saludos,<br>El equipo de EcoSazón</p>
</body>
</html>