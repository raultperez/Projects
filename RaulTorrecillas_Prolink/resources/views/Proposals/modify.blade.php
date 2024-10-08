@extends('layout')

@section('contenido')

    <section class="content">

        <article class="content-2">

            <img src="{{ $proposal->imageUrl }}" alt="Imagen de la oferta">

            <div class="proposal-info">

                <form method="post" action="/proposals/{{ $proposal->id }}/modify" enctype="multipart/form-data" class="modify form">
                    @csrf
                    <label for="name">Titulo:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $proposal->name }}" required>

                    <label for="description">Descripción:</label>
                    <textarea id="description" name="description">{{ old('description') ? old('description') : $proposal->description }}</textarea>

                    <label for="category">Categoria:</label>
                    <select id="category" name="category">
                        <option value="null">-Selecciona una categoria-</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}" @if($category->name == $proposal->category->name) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label for="price_hour">Precio/hora:</label>
                    <input type="number" id="price_hour" name="price_hour" value="{{ old('price_hour') ? old('price_hour') : $proposal->price_hour }}" required>
                    <br>
                    <label for="image">Subir foto:</label>
                    <input id="image" name="image" size="30" accept="image/png" type="file"/><br><br>

                    <button type="submit">Subir</button>
                </form>

            </div>

        </article>

    </section>

@endsection
