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
                case "tasks/add":
                    return $this->taskController->add($payload['task']);
                    break;
                case "tasks/delete":
                    return $this->taskController->delete($payload['id']);
                    break;
                default:
                    return $this->loginController->welcome();
                    break;
            }
        }
    }
