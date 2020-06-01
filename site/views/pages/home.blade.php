@extends('partials.layout')

@section('content')
  <div class="content py-5">
    <div class="row align-items-center">
      @each('task-card', $paginator->items(), 'task')
    </div>
  </div>

  {{ $paginator->links('partials.pagination') }}

@endsection
@section('footer_scripts')

@endsection