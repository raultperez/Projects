@extends('layout')

@section('contenido')

    <section class="content">

        <h1>OFERTAS DE PROLINK</h1>

        <article class="proposal-filter">

            <form method="post" action="/proposals" class="filter">
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

                <div class="price-filter">
                    <label for="priceRange">Selecciona un rango de precio y marca la casilla para filtrar:</label>
                    <div class="priceRange">0€ <input type="range" min="0" max="{{ $higherPrice }}" value="{{ $higherPrice/2 }}" id="priceRange" name="priceRange"> {{ $higherPrice }}€</div>
                    <input type="checkbox" id="filterNumber" name="filterNumber">
                </div>

                <button type="submit">Filtrar</button>
            </form>

        </article>

        <article class="list-4">

            @foreach($proposals as $proposal)

                <div class="card-4">

                    <a href="/proposals/{{ $proposal->id }}"><img src="{{ $proposal->imageUrl }}" alt="Imagen de la oferta"></a>

                    <a href="/proposals/{{ $proposal->id }}"><h3>{{ $proposal->name }}</h3></a>

                    <div class="proposal-summary"><a href="/user/{{ $proposal->professional->user->id }}">{{ $proposal->professional->user->name }}</a><p>{{ $proposal->category->name }}</p></div>

                </div>

            @endforeach

        </article>

        <div class="pagination">
            {{ $proposals->links() }}
        </div>

    </section>

@endsection
