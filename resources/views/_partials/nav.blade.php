<nav class="navbar navbar-dark bg-dark">
  <p class="navbar-brand">{{ config('app.name') }}</p>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home.var-viewer') }}">Vars</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href={{ route('home.constant-viewer') }}>Constants</a>
      </li>
    </ul>
  </div>
</nav>
