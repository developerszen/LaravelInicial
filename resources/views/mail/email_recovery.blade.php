<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Recuperación de contraseña</h1>
        <p>Usuario: {{ $user->name }} </p>
        <p>Por favor siga el siguiente enlace</p>
        <a href="http://laravel-inicial.test/frontend-email?reset_token={{ $user->reset_token }}">
            Seguir enlace
        </a>
    </div>
</body>
</html>