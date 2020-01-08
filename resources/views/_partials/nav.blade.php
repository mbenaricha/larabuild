<nav class="navbar navbar-expand navbar-dark bg-dark">
    <span class="navbar-brand">{{ config('app.name') }}</span>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ url()->current() === route('home.variables') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home.variables') }}">Variables</a>
            </li>
            <li class="nav-item {{ url()->current() === route('home.constants') ? 'active' : '' }}">
                <a class="nav-link" href={{ route('home.constants') }}>Constants</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('home.reset-cache') }}" class="nav-link text-danger">Reset cache</a>
            </li>
        </ul>
    </div>
</nav>
