@extends('layout')

@section('contenido')

    <section class="content">

            <form action="/user/{{ $user->id }}/delete" method="POST" enctype="multipart/form-data" class="modify-form">
                @csrf
                <h2>Formulario de baja de {{ $user->name }}</h2>
                <br>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <label for="rePassword">Repetir Contraseña:</label>
                <input type="password" id="rePassword" name="rePassword" required>

                <button type="submit">Dar de baja</button>

                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </form>

    </section>

@endsection
