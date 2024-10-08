@extends('layout')

@section('contenido')

    <section class="content">

        <div class="content-2">

            <form action="/create" method="POST" enctype="multipart/form-data">

                @csrf
                <h2>¡Sube tu oferta!</h2>
                <br>
                <label for="name">Titulo:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description"></textarea>

                <label for="category">Categoria:</label>
                <select id="category" name="category">
                    <option value="null">-Selecciona una categoria-</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="addCategory">¿No encuentras tu categoria?</label>
                <button class="addCategory" name="addCategory"><a href="/createCategory">Añadir Categoria</a></button>

                <label for="price_hour">Precio/hora:</label>
                <input type="number" id="price_hour" name="price_hour" value="{{ old('price_hour') }}" required>

                <label for="image">Subir foto:</label>
                <input id="image" name="image" size="30" accept="image/png" type="file"/><br><br>

                <button type="submit">Subir</button>

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
                    <h2>Inspiración para tus Ofertas</h2>
                    <ul>
                        <li><strong>Título Claro y Atractivo:</strong> Usa un título que destaque tus habilidades y servicios.</li>
                        <li><strong>Descripción Detallada:</strong> Explica claramente lo que ofreces y cómo puedes ayudar a tus clientes.</li>
                        <li><strong>Precios Competitivos:</strong> Investiga precios del mercado y establece tarifas razonables.</li>
                        <li><strong>Imágenes de Calidad:</strong> Incluye fotos profesionales para atraer más atención.</li>
                        <li><strong>Categoría Adecuada:</strong> Elige la categoría que mejor describa tus servicios para que los clientes te encuentren fácilmente.</li>
                    </ul>
                </div>

                <img src="/img/src/imagen_proposal.png" alt="Imagen de categoria">

            </section>

        </div>

    </section>

@endsection
