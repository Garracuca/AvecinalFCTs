<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avecinal - Cooperativa de Alimentos Saludables</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #ffb347; /* Naranja */
        }

        header img {
            height: 60px;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            font-size: 16px;
            color: white;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #004d99; /* Azul */
        }

        .hero {
            text-align: center;
            background: url('{{ asset("img/Port.jpg") }}') no-repeat center center/cover;
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 20px;
            position: relative;
        }

        .hero h1 {
            font-size: 48px;
            margin: 0;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .hero p {
            font-size: 20px;
            margin: 20px 0 0;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        .features {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
        }

        .feature img {
            width: 200px;
            height: 200px;
            border-radius: 10px;
            object-fit: cover;
        }

        .feature:nth-child(odd) {
            flex-direction: row;
        }

        .feature:nth-child(even) {
            flex-direction: row-reverse;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #004d99; /* Azul */
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('img/Logo.png') }}"  alt="Logo de Avecinal"> <!-- Cambia esta URL por tu logo -->
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Inicio</a>
                @else
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrarse</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <div class="hero">
        <h1>AVECINAL</h1>
        <p>¡Ven a hacer la compra a tu supermercado cooperativo, de cercanía y transformador!<br>
        La revolución alimentaria en manos de las personas.
        </p>
    </div>

    <section class="features">
        <div class="feature">
            <img src="{{ asset('img/Zanahoria.jpg') }}"  alt="Característica 1"> 
            <p>Compra productos locales de la más alta calidad directamente de tus agricultores cercanos.</p>
        </div>

        <div class="feature">
            <img src="{{ asset('img/Verde.jpg') }}"  alt="Característica 2"> 
            <p>Transforma tu manera de consumir con alimentos saludables y sostenibles.</p>
        </div>

        <div class="feature">
            <img src="{{ asset('img/reunion.jpg') }}"  alt="Característica 3"> 
            <p>Colabora con una comunidad que apoya el comercio justo y responsable.</p>
        </div>
    </section>

    <footer>
        &copy; 2024 AVECINAL. Todos los derechos reservados.
    </footer>
</body>
</html>
