<?php
    /* Main tasks:
        Project:
            1. Theres probably extra whitespace in my commits somewhere... should remove that
            2. Add Coachmarks to main App page to explain App functions
            3. Add Bio to about button
        Backend:
            1. Add extensive error handling (including when DB is not accessible)
        Frontend:
            1. Templating for views
            2. Add More ADA compliance to the project
            3. Organize app.js yikes
            4. Cleanup the css and make it more responsive
            5. Finalize styling (colors and alignment)
            6. Cleanup the icons to look better
        Known Bugs:
            1. The focus does not go to the input field when the new task modal is opened. See todo in app.js
            2. The task buttons can collide with the labels and descriptions when they are too long
            3. Typewriter will scramble the info text when clicked multiple times, (minor fix by preventing 
               multiple button presses)
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
            include 'views/Components/edit-task-modal.php';
        ?>
    </body>
</html>
