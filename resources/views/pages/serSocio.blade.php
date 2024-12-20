@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 750px; margin: 0 auto;">
    <!-- Título de la página -->
    <h1 class="text-center text-primary mb-4" style="font-size: 3rem; font-weight: bold;">¿Quiénes somos?</h1>
    <p class="text-center" style="font-size: 1.5rem;">En aragonés ‘a vecinal’ hace referencia al trabajo colaborativo que en los pueblos hacen las vecinas y vecinos para apoyar a la comunidad.</p>

    <div class="text-justify mb-5">
        <p>A Vecinal Super Coop es una cooperativa de consumo de Zaragoza que gestiona un supermercado colaborativo donde cualquiera puede realizar su compra semanal de forma asequible, responsable y saludable, y donde las socias tienen el poder de decisión sobre lo que se compra y a quién.</p>
        <p>Nuestro objetivo es contribuir al cuidado del planeta y de las personas ofreciendo una alternativa para la transformación del modelo de consumo actual que maltrata la salud de la tierra y las personas.</p>
    </div>

    <!-- ¿Qué defendemos? -->
    <h2 class="text-secondary mb-4" style="font-size: 2rem;">¿Qué defendemos?</h2>
    <ul class="list-unstyled fs-5">
        <li>🌱 La sostenibilidad económica, social, medioambiental y humana.</li>
        <li>💡 El empoderamiento de las personas, a través de la información y el conocimiento.</li>
        <li>🤝 La cooperación como base de la relación entre las personas y redes locales.</li>
        <li>🍎 La soberanía alimentaria: derecho a decidir sobre cómo y quién produce nuestros alimentos.</li>
        <li>🌍 La diversidad como valor para superar retos y sumar inteligencia colectiva.</li>
        <li>⚖️ La justicia: acceso a alimentos de calidad para todas a precios justos.</li>
        <li>🌸 El ecofeminismo: luchando contra estructuras de dominación heteropatriarcales.</li>
    </ul>

    <p>Nuestro proyecto se inspira en el modelo que puso en marcha Park Slope Food Coop en Brooklyn, Nueva York, en 1973. En España, también contamos con experiencias similares como Landare en Pamplona y Labore en Guipúzcoa.</p>

    <!-- Participación -->
    <h2 class="text-secondary mb-4" style="font-size: 2rem;">Participación</h2>
    <p>El modelo de A Vecinal solo funciona con la participación activa de todas las personas que lo componen: para la construcción del proyecto, la colaboración regular en su funcionamiento y el consumo regular en el supermercado.</p>
    <p>Actualmente ya contamos con más de 320 familias socias, pero es necesaria la implicación de muchas más personas para que la cooperativa sea un éxito.</p>

    <!-- ¿Qué significa ser soci@? -->
    <h2 class="text-primary mb-4" style="font-size: 2.5rem;">¿Qué significa ser soci@?</h2>
    <ul class="list-unstyled fs-5">
        <li>💶 Aportas el capital social inicial: 150 €.</li>
        <li>📜 Serás copropietari@ de A Vecinal Supermercado Cooperativo.</li>
        <li>🛒 Decidirás qué productos hay en las estanterías y los criterios de compra.</li>
        <li>🎉 Beneficios: descuentos especiales (5% por ser socia, 15% con 2 horas de trabajo mensual).</li>
        <li>📚 Acceso a información sobre alternativas de consumo y una comunidad afín.</li>
        <li>⏳ Aportas 2 horas de trabajo mensual para el funcionamiento de la cooperativa.</li>
    </ul>
</div>
@endsection

<style>
    .container {
        max-width: 750px; /* Ajuste para centrar el contenido */
        margin: auto;
        padding: 20px;
    }

    h1, h2 {
        color: #2c3e50;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    p, ul {
        color: #2c3e50;
        line-height: 1.6;
    }

    ul {
        margin-top: 15px;
        list-style-type: none;
    }

    ul li {
        margin-bottom: 10px;
        padding-left: 25px;
        position: relative;
    }

    ul li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #34495e;
    }
</style>
