<div class="col-sm-4 align-self-stretch">
  <div class="card box-shadow" style="height: 100%;">
    <div class="card-body d-flex flex-column">
      <h4 class="card-title">{{ $task['username'] }} </h4>
      <h5 class="card-subtitle mb-2 text-muted">{{ $task['email'] }}</h5>
      <hr>
      <p class="card-text flex-grow-1">{{ $task['content'] }}</p>
      @if($task['edited'])
        <div class="text-center">
          <small class="text-muted">Отредактировано администратором</small>
        </div>
      @endif
      <div class="d-flex justify-content-{{ App\Core\Auth::isLoggedIn() ? 'between' : 'center' }} align-items-center" style="margin-top: 1rem;">
        @if(App\Core\Auth::isLoggedIn())
          <a href="/task/edit?id={{ $task['id'] }}" type="button" class="btn btn-sm btn-outline-secondary">Изменить</a>
        @endif
        <h4><span class="badge badge-secondary {{ $task['done'] ? 'badge-success' : 'badge-warning'}}">
          Задача {{ $task['done'] ? 'выполнена' : 'открыта'}}</span>
        </h4>
      </div>

    </div>
  </div>
</div>