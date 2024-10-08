@extends('layout')

@section('contenido')

    <section class="content">

        <article class="content-2">

            <img src="{{ $user->imageUrl }}" alt="Imagen del usuario">

            <div class="proposal-info">

                <h1>{{ $user->name }} {{ $user->professional ?  $user->professional->surname : ""}}</h1>

                @if($user->company)
                    <p>{{ $user->company->location }}</p>
                @endif

                <p class="category">{{ $user->email }}</p>

                <p class="description">{{ $user->description }}</p>

                @if(auth()->user()->professional)
                    @if(!$working_experience->isEmpty())
                        <article class="work-experience">
                            <h2>Experiencia Laboral</h2>
                            <table>
                                <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Periodo</th>
                                    <th>Descripción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($working_experience as $experience)
                                    <tr>
                                        <td>{{ $experience->company_name }}</td>
                                        <td>{{ $experience->begins_at }} - {{ $experience->ends_at != null ? $experience->ends_at : 'Actualidad' }}</td>
                                        <td>{{ $experience->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </article>
                    @else
                        <p>No hay experiencia profesional anterior disponible</p>
                    @endif
                        <a href="/work" class="addExperience">Añadir Experiencia</a>
                @endif

            </div>

        </article>

        @if($user->id == auth()->user()->id || auth()->user()->isAdmin)

            <article class="manage-buttons">
                <a href="/user/{{ $user->id }}/modify">Modificar perfil</a>
                <a href="/user/{{ $user->id }}/delete">Dar de baja</a>
            </article>

        @endif

        @if($user->professional)
            @if(!$proposals->isEmpty())

                <article class="list-4">

                    @foreach($proposals as $proposal)

                        <div class="card-4">

                            <a href="/proposals/{{ $proposal->id }}"><img src="{{ $proposal->imageUrl }}" alt="Imagen de la oferta"></a>

                            <a href="/proposals/{{ $proposal->id }}"><h3>{{ $proposal->name }}</h3></a>

                            <a href="/user/{{ $proposal->professional->user->id }}">{{ $proposal->professional->user->name }}</a>

                        </div>

                    @endforeach

                </article>

            @else

                <span>No hay ofertas anteriores disponibles</span>

            @endif
        @endif
    </section>

@endsection
