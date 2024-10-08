@extends('layout')

@section('contenido')

    <section class="content">

        <div class="content-2">

            <form action="/createCategory" method="POST" enctype="multipart/form-data">

                @csrf
                <h2>¡Crea una categoria!</h2>
                <br>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>

                <button type="submit">Crear</button>

                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </form>

            <section class="hero">
                <div class="hero-content">
                    <h2>Categorias de Prolink</h2>
                    <p>Empieza a crear categorías para organizar mejor los servicios de consultoría en línea.</p>
                </div>
            </section>

        </div>

    </section>

@endsection
