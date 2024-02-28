<?php 

class TaskController extends Controller{

	public function getTasks() {
        $tasks = $this->user->getTasks();
        return json_encode($tasks);
	}

    public function addTask($task) {
        return $this->user->addTask($task);
    }

    public function addDefaultTasks() {
        $defaultTasks = [
            ['label' => 'Begin Project!', 'description' => 'Time to take on this challenge!', 'dueDate' => '2024-02-23', 'isArchived' => 1],
            ['label' => 'Complete Todo Project!', 'description' => 'Need to finish this project! :D', 'dueDate' => '2024-02-27'],
            ['label' => 'Commence Future Projects!', 'description' => 'Time to tackle some challenges!', 'dueDate' => '2024-03-02']
        ];
        foreach ($defaultTasks as $task) {
            $this->user->addTask($task);
        }
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
