@extends('layout')

@section('contenido')

    <section class="content">

        <article class="cart-section">

            <div class="cart">
                <h2>Carrito</h2>

                @if(!$addedProposals->isEmpty())
                    <table>
                        <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Horas</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($addedProposals as $proposal)
                            <tr class="proposal">
                                <td><img src="{{ $proposal->proposal->imageUrl }}" alt="Imagen de la oferta"></td>
                                <td>{{ $proposal->proposal->name }}</td>
                                <td>{{ $proposal->price }}€</td>
                                <td>{{ $proposal->n_hours }}h</td>
                                <td>{{ $proposal->n_hours * $proposal->price }}€</td>
                                <td>
                                    <form action="/cart/{{ $proposal->id }}/increase" method="post" class="button">
                                        @csrf
                                        <button type="submit">+</button>
                                    </form>
                                    <form action="/cart/{{ $proposal->id }}/decrease" method="post" class="button">
                                        @csrf
                                        <button type="submit">-</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No tienes ofertas en el carrito</p>
                @endif
            </div>

            <form action="/cart/{{ $cart->id }}" method="post" class="summary">
                @csrf
                <h2>Resumen</h2>

                <hr>

                <div>Subtotal</div> <div>{{ $total }}€</div>

                <div>Gastos de gestión</div> <div>Gratis</div>

                <hr>

                <div>Total</div> <div><input type="number" name="total" readonly value="{{ $total }}">€</div>

                <button type="submit">Pagar</button>

            </form>

        </article>

    </section>

@endsection
