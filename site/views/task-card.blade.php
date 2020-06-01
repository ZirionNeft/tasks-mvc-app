<div class="col-sm-4">
  <div class="card box-shadow">
    <div class="card-body">
      <h4 class="card-title">{{ $task['username'] }} </h4>
      <h5 class="card-subtitle mb-2 text-muted">{{ $task['email'] }}</h5>
      <hr>
      <p class="card-text">{{ $task['content'] }}</p>
      <div class="d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-sm btn-outline-secondary">Изменить</button>
        <h4><span class="badge badge-secondary {{ $task['done'] ? 'badge-success' : 'badge-warning'}}">
          {{ $task['done'] ? 'Закрыта' : 'Открыта'}}</span>
        </h4>
      </div>
    </div>
  </div>
</div>