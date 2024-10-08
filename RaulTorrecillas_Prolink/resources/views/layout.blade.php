<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProLink - Consultoría Profesional en Línea</title>
    <link rel="stylesheet" href="/app.css">
    <link rel="icon" href="/img/src/icons/icono_prolink_blue.svg">
    <script src="/responsiveHeader.js"></script>
</head>
<body>
<header>
    <a href="/home"><img src="/img/src/LOGO_PROLINK_white.png" alt="Logo de ProLink"></a>
    @if(auth()->check())
        @if(auth()->user()->isAdmin)
            <nav>
                <ul>
                    <li><a href="/users">Administrar</a></li>
                    <li><a href="/proposals">Ver Ofertas</a></li>
                    <li><a href="/user/{{ auth()->user()->id }}">Mi Perfil</a></li>
                    <li><a href="/logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        @elseif(auth()->user()->company()->exists())
            <nav>
                <ul>
                    <li><a href="/proposals">Ver ofertas</a></li>
                    <li><a href="/professionals">Ver profesionales</a></li>
                    <li><a href="/cart">Ver Carrito</a></li>
                    <li><a href="/user/{{ auth()->user()->id }}">Mi perfil</a></li>
                    <li><a href="/logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        @elseif(auth()->user()->professional()->exists())
            <nav>
                <ul>
                    <li><a href="/create">Subir oferta</a></li>
                    <li><a href="/proposals">Ver ofertas</a></li>
                    <li><a href="/user/{{ auth()->user()->id }}">Mi perfil</a></li>
                    <li><a href="/logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        @endif
    @else
        <nav>
            <ul>
                <li><a href="/register">Registrarse</a></li>
            </ul>
        </nav>
    @endif
</header>

<label id="hamburguesa">
    <input type="checkbox" name="boton-bandera" value="bandera" id="bandera">
    <span></span>
</label>

@yield('contenido')

@if(session()->has('message'))
    <div class="message">
        <p>{{ session('message') }}</p>
    </div>
@endif

<footer>
    <p>&copy; 2024 ProLink - Todos los derechos reservados.</p>
</footer>
</body>
</html>
