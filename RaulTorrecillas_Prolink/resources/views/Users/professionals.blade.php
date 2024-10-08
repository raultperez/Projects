@extends('layout')

@section('contenido')

    <section class="content">

        <h1>PROFESIONALES DE PROLINK</h1>

        <article class="proposal-filter">

            <form method="post" action="/professionals" class="filter">
                @csrf
                <div class="category-filter">
                    <label for="category">Selecciona una categoria: </label>
                    <select name="category">
                        <option value="">-Ninguna-</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Filtrar</button>
            </form>

        </article>

        <article class="list-4">

            @foreach($professionals as $professional)

                <div class="card-4">

                    <a href="/user/{{ $professional->user->id }}"><img src="{{ $professional->user->imageUrl }}" alt="Imagen del profesional"></a>

                    <a href="/user/{{ $professional->user->id }}"><h3>{{ $professional->user->name }}</h3></a>

                </div>

            @endforeach

        </article>

        <div class="pagination">
            {{ $professionals->links() }}
        </div>

    </section>

@endsection
