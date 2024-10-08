@extends('layout')

@section('contenido')

    <section class="content">

        <article class="content-2">

            <img src="{{ $proposal->imageUrl }}" alt="Imagen de la oferta">

            <aside class="proposal-info">

                <h1>{{ $proposal->name }}</h1>

                <a href="/user/{{ $proposal->professional->user->id }}">{{ $proposal->professional->user->name }}</a>

                <p class="category">{{ $proposal->category->name }}</p>

                <p class="description">{{ $proposal->description }}</p>

                <p class="price">{{ $proposal->price_hour }}€/hora</p>

                @if(auth()->user()->professional)
                    @if (auth()->user()->professional->id == $proposal->professional_id || auth()->user()->isAdmin)

                        <a href="/proposals/{{ $proposal->id }}/modify" class="modify-button">Modificar oferta</a>

                    @endif
                @endif

                @if(auth()->user()->company)

                    <hr>

                    <form action="/proposals/{{ $proposal->id }}" method="post">
                        @csrf
                        <label for="hours">Número de horas:</label>
                        <input type="number" id="hours" name="hours" value="1" min="1">

                        <button type="submit">Añadir al carrito</button>

                    </form>

                @endif

            </aside>

        </article>

        @if(!$recomProposals->isEmpty())

        <article class="list-4">

            @foreach($recomProposals as $recomProposal)

                <div class="card-4">

                    <a href="/proposals/{{ $recomProposal->id }}"><img src="{{ $recomProposal->imageUrl }}" alt="Imagen de la oferta"></a>

                    <a href="/proposals/{{ $recomProposal->id }}"><h3>{{ $recomProposal->name }}</h3></a>

                    <a href="/profesionals/{{ $recomProposal->professional->id }}">{{ $recomProposal->professional->user->name }}</a>

                </div>

            @endforeach

        </article>

        @else

            <span>No hay más ofertas de esta categoria</span>

        @endif

    </section>

@endsection
