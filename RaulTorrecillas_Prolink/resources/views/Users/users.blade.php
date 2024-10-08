@extends('layout')

@section('contenido')

    <section class="content">

        <h1>USUARIOS DE PROLINK</h1>

        <article class="proposal-filter">

            <form method="post" action="/users" class="filter">
                @csrf
                <div class="category-filter">
                    <label for="category">Selecciona una categoria: </label>
                    <select name="category">
                        <option value="">-Ninguna-</option>
                        <option value="professional">Profesional</option>
                        <option value="company">Empresa</option>
                    </select>
                </div>

                <button type="submit">Filtrar</button>
            </form>

        </article>

        <article class="list-4">

            @foreach($users as $user)

                <div class="card-4">

                    <a href="/user/{{ $user->id }}"><img src="{{ $user->imageUrl }}" alt="Imagen del usuario"></a>

                    <a href="/user/{{ $user->id }}"><h3>{{ $user->name }}</h3></a>

                </div>

            @endforeach

        </article>

        <div class="pagination">
            {{ $users->links() }}
        </div>

    </section>

@endsection
