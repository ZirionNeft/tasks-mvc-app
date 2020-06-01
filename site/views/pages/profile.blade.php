@extends('partials.layout')

@section('content')
  @php
    use App\Core\Auth;
  @endphp

  <div class="content py-5">
    <div class="row">
      <div class="col text-center">
        <h1 class="display-4">{{ Auth::currentUsername() }}</h1>
        <h5 class="text-muted">Ваш профиль</h5>
      </div>
    </div>
    <div class="row py-5">
      <div class="col text-center">
        <a class="btn-danger btn" href="/admin/logout">Выйти из аккаунта</a>
      </div>
    </div>
  </div>

@endsection
@section('footer_scripts')

@endsection