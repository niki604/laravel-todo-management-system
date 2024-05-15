<?php

namespace App;

use App\Http\Controllers\TaskController;
use App\Models\Task;

class TaskService {

  public function getTaskList()
  {
    $result = Task::query()->get();
    return $result;
  }

}