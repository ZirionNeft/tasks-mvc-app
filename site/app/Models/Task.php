<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Task extends Model
{

  public function getAll($orderColumn = 'id', $orderBy = self::ORDER_DESC): array
  {
    return parent::fetchAssocArray("SELECT id,username,email,content,done,edited FROM tasks ORDER BY {$orderColumn} {$orderBy}");
  }

  public function getById(int $id): array
  {
    return parent::fetchRow("SELECT id,username,email,content,done,edited FROM tasks WHERE id={$id} LIMIT 1");
  }

  public function create(array $data): int
  {
    $statement = parent::getConnection()->prepare("INSERT INTO tasks (username, email, content) VALUES (:username, :email, :content)");
    return $statement->execute($data);
  }

  public function update(array $data): int
  {
    $statement = parent::getConnection()->prepare("UPDATE tasks SET done=:done, content=:content, edited=:edited WHERE id=:id");
    $statement->bindValue(':done', $data['done'], PDO::PARAM_BOOL);
    $statement->bindValue(':content', $data['content']);
    $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);
    $statement->bindValue(':edited', $data['edited'], PDO::PARAM_BOOL);
    return $statement->execute();
  }
}