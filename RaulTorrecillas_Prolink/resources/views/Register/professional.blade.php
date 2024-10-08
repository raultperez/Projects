@extends('layout')

@section('contenido')

    <section class="content">

        <div class="content-2">

            <form action="/register" method="POST" enctype="multipart/form-data">

                @csrf
                <h2>¡Sube tus ofertas!</h2>
                <br>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                <label for="surname">Apellido:</label>
                <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required>

                <label for="age">Edad:</label>
                <input type="number" id="age" name="age" value="{{ old('age') }}" required>

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <label for="category">Categoria:</label>
                <select id="category" name="category">
                    <option value="null">-Selecciona una categoria-</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <button><a href="/createCategory">Añadir Categoria</a></button>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>

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

            <img src="/img/src/imagen_professional.png" alt="Imagen de categoria">

        </div>

    </section>

@endsection
