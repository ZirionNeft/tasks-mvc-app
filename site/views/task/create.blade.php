@extends('partials.layout')

@section('content')
  <div class="content py-5">
    <div class="row">
      <div class="col">
        <form method="POST" class="@if(!empty($errors)) needs-validation @endif" action="{{ $currentRoute }}" @if(!empty($errors)) novalidate @endif>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="email_input">E-Mail:</label>
                <input required value="{{ $data['email'] }}" name="email" type="email" class="form-control form-control-lg @isset($errors["email"]) is-invalid @endisset" id="email_input" placeholder="Введите E-Mail">
                @isset($errors['email'])
                <div class="invalid-feedback">
                  {{ $errors['email'][0] }}
                </div>
                @endisset
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="username_input">Имя пользователя:</label>
                <input required value="{{ $data['username'] }}" name="username" type="text" class="form-control form-control-lg @isset($errors["username"]) is-invalid @endisset" id="username_input" placeholder="Введите имя пользователя">
                @isset($errors['username'])
                  <div class="invalid-feedback">
                    {{ $errors['username'][0] }}
                  </div>
                @endisset
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="content_input">Текст задачи:</label>
            <textarea name="content" required class="form-control form-control-lg @isset($errors["content"]) is-invalid @endisset" id="content_input" rows="7">{{ $data['content'] }}</textarea>
            @isset($errors['content'])
              <div class="invalid-feedback">
                {{ $errors['content'][0] }}
              </div>
            @endisset
          </div>

          <button type="submit" class="btn btn-primary float-right">Отправить</button>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('footer_scripts')

@endsection