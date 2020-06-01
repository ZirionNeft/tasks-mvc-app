@extends('partials.layout')

@section('content')
  <div class="content py-5">
    <div class="row">
      <div class="col">
        <form method="POST" class="@if(!empty($errors)) needs-validation @endif" action="{{ $currentRoute }}" @if(!empty($errors)) novalidate @endif>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="login_input">Логин:</label>
                <input required value="{{ $data['login'] }}" name="login" type="text" class="form-control form-control-lg @isset($errors["login"]) is-invalid @endisset" id="login_input" placeholder="Введите логин">
                @isset($errors['login'])
                  <div class="invalid-feedback">
                    {{ $errors['login'][0] }}
                  </div>
                @endisset
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="password_input">Пароль:</label>
                <input required value="{{ $data['password'] }}" name="password" type="password" class="form-control form-control-lg @isset($errors["password"]) is-invalid @endisset" id="password_input" placeholder="Введите пароль">
                @isset($errors['password'])
                  <div class="invalid-feedback">
                    {{ $errors['password'][0] }}
                  </div>
                @endisset
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary float-right">Отправить</button>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('footer_scripts')

@endsection