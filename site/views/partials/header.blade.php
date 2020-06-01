<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  @php
    use App\Core\Auth;
  @endphp
  <a class="navbar-brand" href="/">ЗАДАЧИ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        @if(Auth::isLoggedIn())
          <a class="nav-link" href="/admin/profile">{{ Auth::currentUsername() }}</a>
        @else
          <a class="nav-link" href="/admin/login">Авторизация</a>
        @endif
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a href="/task/create" class="btn btn-outline-success my-2 my-sm-0">Добавить задачу</a>
    </form>
  </div>
</nav>