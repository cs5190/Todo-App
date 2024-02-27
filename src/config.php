<?php
    define('DBDRIVER', 'mysql');
    define('DBNAME', 'todo2024');
	define('DBHOST', 'localhost');
    define('DBPORT', '3306');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('ROOT', 'localhost:8000');

    require 'src/Models/Database.php';
    require 'src/Models/User.php';
    require 'src/Repository/RequestRouter.php';
    require 'src/Repository/Controller.php';
    require 'src/Repository/LoginController.php';
    require 'src/Repository/TaskController.php';
