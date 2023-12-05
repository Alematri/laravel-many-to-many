<header class="bg-dark">
    <div class="navbar navbar-dark">
        <div class="container-fluid">
          <a href="{{route('home')}}" target="_blank" class="navbar-brand">Vai al sito</a>
          <form action="{{route('admin.projects.index')}}" method="GET">
            <input name="toSearch" class="form-control" type="search" placeholder="cerca" aria-label="Search">
          </form>
          <a href="{{ route('profile.edit')}}" class="text-white text-decoration-none">Utente: <strong>{{Auth::user()->name}}</strong></a>
          <form action="{{route('logout')}}" method="POST" class="d-flex" role="search">
            @csrf
            <button class="btn btn-light" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
          </form>
        </div>
      </div>
</header>
