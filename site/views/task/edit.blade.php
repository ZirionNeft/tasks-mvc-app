@extends('partials.layout')

@section('content')
  <div class="content py-5">
    <div class="row">
      <h1>Редактирование задачи</h1>
    </div>
    <div class="row py-5">
      <div class="col">
        <form method="POST" class="@if(!empty($errors)) needs-validation @endif" action="{{ $currentRoute }}?id={{ $data['id'] }}" @if(!empty($errors)) novalidate @endif>
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="email_input">E-Mail:</label>
                <input required value="{{ $data['email'] }}" name="email" type="email" class="form-control form-control-lg" id="email_input" disabled>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="username_input">Имя пользователя:</label>
                <input required value="{{ $data['username'] }}" name="username" type="text" class="form-control form-control-lg" id="username_input" disabled>
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
          <div class="form-check">
            <input type="checkbox" name="done" {{ $data['done'] ? 'checked' : '' }} value="{{ (int)$data['done'] }}" class="form-check-input" id="done_input">
            <label class="form-check-label" for="done_input">Задача завершена</label>
          </div>

          <button type="submit" class="btn btn-primary float-right">Отправить</button>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('footer_scripts')
  <script>
    $('#done_input').on('change', function() {
      $(this).val(+this.checked);
    });
  </script>
@endsection