Vista principal de un admin
<br>
Hay que usar una layout de dashboard y añadir las secciones
<br>
<!--Esto será parte del menu de admin-->
<a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<!--Esto será parte del menu de admin-->

<br>

<a href="{{route('admin.index')}}">usuarios</a>