<?php
    require 'src/config.php';

    session_start();

    $requestRouter = new RequestRouter();
    $route = $_POST["route"] ?? (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] ? 'tasks' : 'welcome');
    $payload = $_POST["payload"] ?? [];

    if ($route == "logout") {
        session_destroy();
        $route = 'welcome';
    }

    $currentPageData = $requestRouter->routeToController($route, $payload);

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // This is an AJAX request, so only return the #page content
        echo $currentPageData;
        exit;
    }
