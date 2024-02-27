<?php 

class User
{
    use Database;
    protected $table = 'users';

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
          FROM $this->table
         WHERE username = :username
        SQL;
        $data = ['username' => $username];
        return $this->runQuery($query, $data) ?? false;
    }

    public function getPassword() {
        $query = <<<SQL
        SELECT password
          FROM $this->table
         WHERE username = :username
        SQL;
        $data = ['username' => $this->username];
        return $this->runQuery($query, $data) ?? false;
    }

    public function createNewUser($username, $password) {
        $query = <<<SQL
        INSERT INTO $this->table
                    (username, password)
             VALUES (:username, :password)
        SQL;
        $data = ['username' => $username, 'password' => $password];
        return $this->runQuery($query, $data) ?? false;
    }
}
