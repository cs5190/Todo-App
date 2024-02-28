<?php
    class RequestRouter
    {
        private $loginController;
        private $taskController;

        public function __construct() {
            $this->loginController = new LoginController();
            $this->taskController = new TaskController();
        }

        public function routeToController($route, $payload = [])
        {
            switch($route)
            {
                case 'welcome':
                    return $this->loginController->welcome();
                    break;
                case 'userExists':
                    return $this->loginController->userExists($payload['username']);
                    break;
                case "login":
                    return $this->loginController->login($payload['password']);
                    break;
                case "create":
                    return $this->loginController->createNewUser($payload['password']);
                    break;
                case "tasks":
                    return $this->taskController->render('tasks');
                    break;
                case "tasks/get":
                    return $this->taskController->getTasks();
                    break;
                case "tasks/add":
                    return $this->taskController->addTask($payload['task']);
                    break;
                case "tasks/archive":
                    return $this->taskController->archiveTask($payload['id']);
                    break;
                case "tasks/restore":
                    return $this->taskController->restoreTask($payload['id']);
                    break;
                case "tasks/delete":
                    return $this->taskController->deleteTask($payload['id']);
                    break;
                default:
                    return $this->loginController->welcome();
                    break;
            }
        }
    }
