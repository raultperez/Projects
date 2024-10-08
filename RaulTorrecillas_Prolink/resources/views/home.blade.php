@extends('layout')

@section('contenido')

    <section class="content">

        <article class="content-2">
            <img alt="Imagen de bienvenida" src="/img/src/imagen_home.png">
            <div class="card-2">
                <div>
                    <h2>Bienvenido {{ auth()->user()->name }}</h2>
                    <h3>ProLink es una plataforma de conexión laboral. Encuentra oportunidades de trabajo como profesional y como empresa.</h3>
                </div>
                @if(auth()->user()->isAdmin)

                        <a href="/users">Administrar usuarios</a>
                @else
                        @if(auth()->user()->company()->exists())
                            <a href="/proposals">Ver Ofertas</a>
                        @else
                            <a href="/create">Subir Ofertas</a>
                        @endif
                @endif
            </div>
        </article>

        <h2>Nuestros profesionales de ProLink</h2>

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
