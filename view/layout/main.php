<?php
include '_partial/helper.php';

use App\Auth;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS  -->
        <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="public/bootstrap/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link href="/public/css/companyadd.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <link rel="stylesheet" type="text/css" href="public/css/style.css" />

        <title>IvelinFirstProject</title>
    </head>
    <body style="background-color: lightgrey;">

        <?php if (Auth::isLogged()) { ?>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Hi, <?php echo Auth::getUsername(); ?> </a> <a href="/avatarupload?id=<?php echo Auth::getUserId(); ?>"><img src="<?php echo Auth::getUserAvatar(); ?>" style="max-width: 60px; border-radius: 89%;">
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav" style="float: right;">
                                    <li>
                                        <a href="/companylist" style="top: -30px">Companies</a>
                                    </li>
                                    <li>
                                        <a href="/personlist">Persons</a>
                                    </li>
                                    <li>
                                        <a href="/userlist">Users</a>
                                    </li>
                                    <li>
                                        <a href="/logout">Log out</a>
                                    </li>
                                </ul>
                            </div>
                    </div>
            </nav>
           <div class = "main" style="text-align: center;">
                <div class="alert" style="margin: auto;">
                    <?php
                    echo App\FlashMessage::getMessage();
                    ?>
                </div> 
            <?php } ?>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="/view/layout/main.js"></script>
    </body>