<ul class="nav nav-list">
    <li @if(Route::is('dashboard')) class="active" @endif>
        <a href="{{ url('dashboard') }}">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> Dashboard </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li @if(Route::is('user') || Route::is('user.create') || Route::is('user.edit') || Route::is('user.show')) class="active" @endif >
        <a href="{{ route('user') }}">
            <i class="menu-icon glyphicon glyphicon-user "></i>
            <span class="menu-text"> User </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li @if(Route::is('client') || Route::is('client.create') || Route::is('client.edit') || Route::is('client.show')) class="active" @endif >
        <a href="{{ route('client') }}">
            <i class="menu-icon glyphicon glyphicon-user "></i>
            <span class="menu-text"> Client </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li @if(Route::is('tiket') || Route::is('tiket.create') || Route::is('tiket.edit') || Route::is('tiket.show')) class="active" @endif >
        <a href="{{ route('tiket') }}">
            <i class="menu-icon glyphicon glyphicon-pencil"></i>
            <span class="menu-text"> Tiket </span>
        </a>

        <b class="arrow"></b>
    </li>


</ul><!-- /.nav-list -->