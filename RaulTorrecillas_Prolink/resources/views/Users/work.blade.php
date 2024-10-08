@extends('layout')

@section('contenido')

    <section class="content">

        <div class="content-2">

            <form action="/work" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>¡Registra tu experiencia laboral!</h2>
                <br>
                <div>
                    <label for="company_name">Nombre de la empresa:</label>
                    <input type="text" id="company_name" name="company_name" required>
                </div>
                <div>
                    <label for="begins_at">Fecha de inicio:</label>
                    <input type="date" id="begins_at" name="begins_at" required>
                </div>
                <div>
                    <label for="ends_at">Fecha de finalización (opcional):</label>
                    <input type="date" id="ends_at" name="ends_at">
                </div>
                <div>
                    <label for="description">Descripción:</label>
                    <textarea id="description" name="description" rows="4" cols="50"></textarea>
                </div>
                <div>
                    <button type="submit">Enviar</button>
                    <button type="button"><a href="/">Omitir</a></button>
                </div>
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
                    <h2>Consultoría Profesional en Línea</h2>
                    <p>Conectamos expertos con clientes en busca de asesoramiento especializado.</p>
                </div>
            </section>

        </div>

    </section>

@endsection
