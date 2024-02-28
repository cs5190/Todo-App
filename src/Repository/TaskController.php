<?php 

class TaskController extends Controller{

	public function getTasks() {
        $tasks = $this->user->getTasks();
        return json_encode($tasks);
	}

    public function addTask($task) {
        return $this->user->addTask($task);
    }

    public function archiveTask($id) {
        return $this->user->archiveTask($id);
    }

    public function restoreTask($id) {
        return $this->user->restoreTask($id);
    }

    public function deleteTask($id) {
        return $this->user->deleteTask($id);
    }
}
