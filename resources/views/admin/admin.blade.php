Vista principal de un admin

Hay que usar una layout de dashboard y añadir las secciones
<a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a></li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>i

<a href="{{route('admin.index')}}">usuarios</a>