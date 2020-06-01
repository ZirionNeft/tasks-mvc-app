@extends('partials.layout')

@section('content')
  <div class="content py-5">
    <div class="row">
      <div class="input-group col-5">
        <div class="input-group-prepend">
          <label class="input-group-text" for="order_column">Сортировка</label>
        </div>
        <select class="custom-select" id="order_column">
          <option value="1" @if($order['column'] === '1') selected @endif>По E-mail</option>
          <option value="2" @if($order['column'] === '2') selected @endif>По имени</option>
          <option value="3" @if($order['column'] === '3') selected @endif>По статусу</option>
        </select>
        <select class="custom-select" id="order_type">
          <option value="1" @if($order['type'] === '1') selected @endif>По убыванию</option>
          <option value="2" @if($order['type'] === '2') selected @endif>По возрастанию</option>
        </select>
      </div>
    </div>
    <div class="row align-items-center py-5">
      @each('task-card', $paginator->items(), 'task')
    </div>
  </div>

  {{ $paginator->links('partials.pagination') }}

@endsection
@section('footer_scripts')
  <script>
    $('#order_column').on('change', function () {
      Cookies.set('order_column', $(this).val());
      window.location.reload();
    });
    $('#order_type').on('change', function () {
      Cookies.set('order_type', $(this).val());
      window.location.reload();
    });

  </script>
@endsection