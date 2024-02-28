<?php 

class User
{
    use Database;
    protected $userTable = 'users';
    protected $taskTable = 'tasks';

    protected $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username ?? false;
    }

    public function userExists($username) {
        $query = <<<SQL
        SELECT username
          FROM $this->userTable
         WHERE username = :username
        SQL;
        $data = ['username' => $username];
        return $this->runQuery($query, $data) ?? false;
    }

    public function getPassword() {
        $query = <<<SQL
        SELECT password
          FROM $this->userTable
         WHERE username = :username
        SQL;
        $data = ['username' => $this->username];
        return $this->runQuery($query, $data) ?? false;
    }

    public function createNewUser($username, $password) {
        $query = <<<SQL
        INSERT INTO $this->userTable
                    (username, password)
             VALUES (:username, :password)
        SQL;
        $data = ['username' => $username, 'password' => $password];
        return $this->runInsert($query, $data);
    }

    public function getTasks() {
        $query = <<<SQL
         SELECT t.taskId, t.label, t.description, t.dueDate, t.isArchived
         FROM tasks t
         JOIN users u on t.userId = u.userId
         WHERE u.username = :username
        SQL;
        $data = ['username' => $this->username];
        return $this->runQuery($query, $data);
    }

    public function addTask($task) {
        $query = <<<SQL
        INSERT INTO $this->taskTable
                    (label, description, dueDate, userId)
             VALUES (:label, :description, :dueDate, (SELECT userId FROM $this->userTable WHERE username = :username))
        SQL;
        $data = ['label' => $task['label'], 'description' => $task['description'], 'dueDate' => $task['dueDate'], 'username' => $this->username];
        return $this->runInsert($query, $data);
    }

    public function deleteTask($id) {
        $query = <<<SQL
        DELETE FROM $this->taskTable
              WHERE taskId = :id
        SQL;
        $data = ['id' => $id];
        return $this->runQuery($query, $data);
    }
}
