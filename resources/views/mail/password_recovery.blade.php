<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Recuperación de contraseña</h1>
        <p>Usuario: {{ $user->name }}</p>
        <a href="http://laravel-inicial.test/formulario-frontend?reset_token={{ $user->reset_token }}">
            Seguir enlace
        </a>
    </div>
</body>
</html>