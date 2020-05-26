<?php

namespace App\Models;

use App\Core\Model;

class Task extends Model
{
  public function getAll()
  {
    return parent::fetchAssocArray('SELECT id,name,email,text,done FROM tasks');
  }

  public function getById(int $id): array
  {
    return parent::fetchRow("SELECT id,name,email,text,done FROM tasks WHERE id={$id}");
  }

  public function create(array $data): int
  {
    return parent::getConnection()->exec("INSERT INTO tasks (name, email, text, done) VALUES ({$data['name']}, {$data['email']}, {$data['text']}, {$data['done']})");
  }

  public function update(int $data): int
  {
    return parent::getConnection()->exec("UPDATE tasks SET done={$data['done']}, text=`{$data['text']}` WHERE id={$data['id']}");
  }
}