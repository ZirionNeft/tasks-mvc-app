<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Task extends Model
{
  public function getAll(): array
  {
    return parent::fetchAssocArray('SELECT id,username,email,content,done FROM tasks');
  }

  public function getById(int $id): array
  {
    return parent::fetchRow("SELECT id,username,email,content,done FROM tasks WHERE id={$id}");
  }

  public function create(array $data): int
  {
    $statement = parent::getConnection()->prepare("INSERT INTO tasks (username, email, content) VALUES (:username, :email, :content)");
    return $statement->execute($data);
  }

  public function update(array $data): int
  {
    $statement = parent::getConnection()->prepare("UPDATE tasks SET done=:done, content=:content WHERE id=:id");
    $statement->bindValue(':done', $data['done'], PDO::PARAM_BOOL);
    $statement->bindValue(':content', $data['content']);
    $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);
    return $statement->execute();
  }
}