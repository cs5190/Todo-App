<?php
    /* Main tasks:
        Project:
            1. Theres probably extra whitespace in my commits somewhere... should remove that
        Backend:
            1. Add extensive error handling
        Frontend:
            1. Templating for views
            2. Add More ADA compliance to the project
            3. Organize app.js yikes
            4. Cleanup the css and make it more responsive
    
        Known Bugs:
            1. (BIGish...) The default tasks will load every time if the users tasks are empty, this should be changed to a first time login basis
              This also means that when you add a task the default tasks will dissapear, which is strange. Easily fixed by simple inserting them to the DB on first login
            1. The focus does not go to the input field when the new task modal is opened. See todo in app.js
            2. The task buttons can collide with the labels and descriptions when they are too long
    */

    require 'src/Application.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Todo App</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/app.css"/>
        <script src="js/jQuery/jquery-3.7.1.min.js"></script>
        <script src="js/bootstrap/bootstrap.js"></script>
        <script src="js/app.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand text-black" href="#" aria-label="Todo App Home">Todo App</a>
                </div>
            </div>
        </nav>
        <main class="main-content-container container" role="main">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="page-container">
                        <div id="mainPageContent">
                            <?php echo $currentPageData ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include 'views/Components/add-task-modal.php';
            include 'views/Components/error-modal.php';
            include 'views/Components/about-modal.php';
        ?>
    </body>
</html>
