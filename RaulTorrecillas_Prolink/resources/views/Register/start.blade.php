@extends('layout')

@section('contenido')

    <section class="content">

        <div class="content-register">

            <h2>Elige tu tipo de cuenta</h2>

            <hr>

            <div class="content-2">

                <div class="card-1">
                    <img src="/img/src/company_register_image.png" alt="Imagen de Empresa">
                    <a href="/register/empresa">EMPRESA</a>
                </div>

                <div class="card-1">
                    <img src="/img/src/professional_register_image.png" alt="Imagen de Profesional">
                    <a href="/register/profesional">PROFESIONAL</a>
                </div>

            </div>

        </div>

    </section>

@endsection
