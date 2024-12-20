<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bienvenido a tu cooperativa Avecinal') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f9f9f9; padding: 20px;">
        <div class="container" style="max-width: 900px; margin: auto;">
            <!-- Sección central con imagen -->
            <div class="text-center mb-5">
                <img src="/images/quienes-somos.jpg" alt="Quienes Somos" class="img-fluid rounded shadow-lg" style="max-width: 80%; height: auto;">
                <h2 class="text-primary mt-4" style="font-size: 1.8rem; font-weight: bold;">¿Quiénes somos?</h2>
                <p class="mt-3" style="font-size: 1.1rem; line-height: 1.8em;">
                    En aragonés ‘a vecinal’ hace referencia al trabajo colaborativo que en los pueblos hacen las vecinas y vecinos para apoyar a la comunidad.
                </p>
            </div>

            <!-- Sección "Qué defendemos" -->
            <div class="d-flex align-items-center mb-5">
                <div class="w-50">
                    <img src="/images/que-defendemos.jpg" alt="Qué Defendemos" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">
                </div>
                <div class="ms-4">
                    <h2 class="text-primary" style="font-size: 1.8rem; font-weight: bold;">¿Qué defendemos?</h2>
                    <ul style="font-size: 1.1rem; line-height: 1.8em; list-style: disc; padding-left: 20px;">
                        <li>La sostenibilidad económica, social, medio ambiental y humana.</li>
                        <li>El empoderamiento de las personas, a través de la información y el conocimiento.</li>
                        <li>La cooperación como base de la relación entre las personas dentro de la cooperativa.</li>
                        <li>La justicia defendiendo el acceso a alimentos de calidad para todas a precios justos.</li>
                    </ul>
                </div>
            </div>

            <!-- Sección "Ser Soci@" -->
            <div class="d-flex align-items-center mb-5">
                <div class="me-4">
                    <h2 class="text-primary" style="font-size: 1.8rem; font-weight: bold;">¿Qué significa ser soci@?</h2>
                    <ul style="font-size: 1.1rem; line-height: 1.8em; list-style: disc; padding-left: 20px;">
                        <li>Aportas el capital social inicial: 150 €.</li>
                        <li>Serás copropietari@ de A Vecinal Supermercado Cooperativo.</li>
                        <li>Podrás decidir qué productos hay en las estanterías y a quién se compra.</li>
                        <li>Te beneficiarás de descuentos especiales.</li>
                        <li>Aportas 2 horas de trabajo mensual para el funcionamiento de la cooperativa.</li>
                    </ul>
                </div>
                <div class="w-50">
                    <img src="/images/ser-socio.jpg" alt="Ser Soci@" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
