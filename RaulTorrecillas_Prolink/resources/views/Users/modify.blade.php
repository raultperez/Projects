@extends('layout')

@section('contenido')

    <section class="content">

            <form action="/user/{{ $user->id }}/modify" method="POST" enctype="multipart/form-data" class="modify-form">
                @csrf
                <h2>Modificación de {{ $user->name }}</h2>
                <br>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $user->name }}" required>

                @if($user->professional)
                <label for="surname">Apellido:</label>
                <input type="text" id="surname" name="surname" value="{{ old('surname') ? old('surname') : $user->professional->surname }}" required>

                <label for="age">Edad:</label>
                <input type="number" id="age" name="age" value="{{ old('age') ? old('age') : $user->professional->age }}" required>
                @endif

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') ? old('email') : $user->email }}" required>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description">{{ old('description') ? old('description') : $user->description }}</textarea>

                <label for="image">Actualizar foto:</label>
                <input id="image" name="image" size="30" accept="image/png" type="file"/>

                @if($user->company)
                <label for="location">Localización:</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}">
                @endif

                @if($user->professional)
                    @if(!$working_experience->isEmpty())
                    <h2>Experiencia Laboral</h2>

                    <table class="user-professional-table">
                        <thead>
                        <tr>
                            <th><label for="company_name">Empresa</label></th>
                            <th><label for="begins_at">Empieza</label> - <label for="ends_at">Acaba</label></th>
                            <th><label for="work_description">Descripción</label></th>
                            <th>Administrar</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($working_experience as $index => $experience)
                            <tr>
                                <td>
                                    <input type="text" id="company_name_{{ $index }}" name="company_name[{{ $index }}]" value="{{ old('company_name.'.$index) ? old('company_name.'.$index) : $experience->company_name }}" required>
                                </td>
                                <td>
                                    <input class="date-modify" type="date" id="begins_at_{{ $index }}" name="begins_at[{{ $index }}]" value="{{ old('begins_at.'.$index) ? old('begins_at.'.$index) : $experience->begins_at }}" required>
                                    <input class="date-modify" type="date" id="ends_at_{{ $index }}" name="ends_at[{{ $index }}]" value="{{ old('ends_at.'.$index) ? old('ends_at.'.$index) : $experience->ends_at }}">
                                </td>
                                <td>
                                    <textarea id="work_description_{{ $index }}" name="work_description[{{ $index }}]" required>{{ old('work_description.'.$index) ? old('work_description.'.$index) : $experience->description }}</textarea>
                                </td>
                                <td>
                                    <a href="/work/{{ $experience->id }}" class="delete">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    @else
                        <p>No hay experiencia profesional anterior disponible</p>
                    @endif
                @endif

                <button type="submit">Actualizar perfil</button>

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
