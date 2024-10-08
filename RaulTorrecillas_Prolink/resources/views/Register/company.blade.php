@extends('layout')

@section('contenido')

    <section class="content">

        <div class="content-2">

            <form action="/register" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>¡Empieza a encontrar Profesionales!</h2>
                <br>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>

                <label for="location">Localización:</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}">

                <label for="image">Subir foto:</label>
                <input id="image" name="image" size="30" accept="image/png" type="file"/><br><br>

                <button type="submit">Registrarse</button>
                <p><a href="/" class="login-link">¿Ya tienes cuenta? Inicia sesión aquí</a></p>

                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </form>

            <section class="inspiration">
                <div class="inspiration-content">
                    <h2>Encuentra las mejores OFERTAS</h2>
                    <ul>
                        <li><strong>Variedad de categorias:</strong> Usa un título que destaque tus habilidades y servicios.</li>
                        <li><strong>Descripción Detallada:</strong> Las ofertas cuentan con una descripción.</li>
                        <li><strong>Precios Competitivos:</strong> Precios ajustados al mercado.</li>
                        <li><strong>Confianza:</strong> Puedes investigar la experiencia que tiene el profesional de la oferta.</li>
                        <li><strong>Profesionalidad:</strong> Aseguramos un trato con el profesional ajustado a la oferta.</li>
                    </ul>
                </div>

                <img src="/img/src/imagen_company.png" alt="Imagen de categoria">

            </section>

        </div>

    </section>

@endsection
