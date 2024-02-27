<?php
    // Main tasks:
    //   Project:
    //     1. Successful Task CRUD
    //     2. Username and password requirements verification
    //   Backend:
    //     1. Flesh out the TaskController
    //     2. Add error handling
    //   Frontend:
    //     1. Flesh out the views, possible templating?
    //     2. Add More scripts in app.js
    //     3. Flesh out CSS and general vibe of the project
    //     5. Add ADA compliance to the project
    //     6. Flesh out Im New Button to change verbage on the page or get rid of it
    //     7. Possible Archived section using good effects
    //     8. Make it pretty

    require 'src/Application.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Todo App</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/app.css"/>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Todo App</a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="page-container">
                        <div id="mainPageContent">
                            <?php echo $currentPageData ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="js/jQuery/jquery-3.7.1.min.js"></script>
<script src="js/bootstrap/bootstrap.js"></script>
<script src="js/app.js"></script>
