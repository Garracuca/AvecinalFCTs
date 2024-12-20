@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Título de la página -->
    <h1 class="text-center text-primary mb-4" style="font-size: 3rem; font-weight: bold;">📞 Contacto</h1>
    <p class="text-center" style="font-size: 1.5rem;">¡Contáctanos para cualquier consulta!</p>

    <!-- Información de contacto -->
    <ul class="list-unstyled text-center mt-4">
        <li style="font-size: 1.2rem; margin-bottom: 10px;"><strong>📍 Dirección:</strong> Calle Inventada, 123, Zaragoza</li>
        <li style="font-size: 1.2rem; margin-bottom: 10px;"><strong>📧 E-mail:</strong> <a href="mailto:info@avecinal.org" style="text-decoration: none; color: #007bff;">info@avecinal.org</a></li>
        <li style="font-size: 1.2rem; margin-bottom: 10px;"><strong>📞 Teléfono:</strong> <a href="tel:876050071" style="text-decoration: none; color: #007bff;">876 05 00 71</a></li>
        <li style="font-size: 1.2rem; margin-bottom: 10px;"><strong>🕒 Horario:</strong> Lunes a Viernes: 8:00 a 21:00</li>
        <li style="font-size: 1.2rem; margin-bottom: 10px;"><strong>📬 Fines de semana:</strong> Contacto por email</li>
    </ul>

    <!-- Redes sociales -->
    <div class="social-links text-center mt-5">
        <h2 class="text-secondary mb-3" style="font-size: 1.8rem;">Síguenos en nuestras redes sociales</h2>
        <a href="https://instagram.com/avecinal" target="_blank" class="social-icon" style="margin: 0 10px; font-size: 1.5rem;">
            <span style="font-size: 2rem;">📸</span> Instagram: <strong>@avecinal</strong>
        </a>
        <br>
        <a href="https://x.com/avecinal" target="_blank" class="social-icon" style="margin: 0 10px; font-size: 1.5rem;">
            <span style="font-size: 2rem;">🐦</span> X (Twitter): <strong>@avecinal</strong>
        </a>
    </div>
</div>
@endsection

<style>
    /* Estilo para el contenedor principal */
    .container {
        max-width: 700px;
        margin: auto;
        text-align: center;
    }

    /* Título de la página */
    h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    /* Lista de información */
    ul {
        font-size: 1.3rem;
        list-style-type: none;
        padding: 0;
    }

    ul li {
        margin-bottom: 15px;
    }

    /* Estilo de los enlaces de redes sociales */
    .social-links a {
        color: #007bff;
        text-decoration: none;
        font-size: 1.3rem;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .social-links a:hover {
        color: #0056b3;
        transform: scale(1.1);
    }
</style>
