@extends('layout')

@section('contenido')

    <section class="content">

        <div class="content-2">

            <section class="hero">
                <div class="hero-content">
                    <h2>Consultoría Profesional en Línea</h2>
                    <p>Conectamos expertos con clientes en busca de asesoramiento especializado.</p>
                </div>
            </section>

            <form action="/login" method="post" class="session-form">
                <h2>Iniciar Sesión</h2>
                @csrf
                <label>
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                </label>
                <label>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </label>

                <button type="submit">Acceder</button>

                @if($errors->any())
                    <ul class="errors">
                        @foreach($errors->all() as $error)
                            <li class="error">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </form>

        </div>

    </section>

@endsection
