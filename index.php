<?php
include_once("db-connection.php");
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Pračenje ocjena učenika</title>
        <meta name="description" content="App for student grades">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="third-party/bootstrap-4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="third-party/fontawesome-free-5.3.1-web/css/all.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="body" class="p-0">
            <h1 class="main-heading text-center text-white pt-5 pb-5">Pregledajte izvještaje</h1>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="report1.php" class="report-box mb-5">
                            <h1>Broj učenika po školi i prosječna ocjena po školi</h1>
                            <i class="far fa-file-alt fa-10x"></i>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="report2.php" class="report-box mb-5">
                            <h1>Broj učenika po razredima i prosječna ocjena po razredu.</h1>
                            <i class="far fa-file-alt fa-10x"></i>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="report3.php" class="report-box mb-5">
                            <h1>Top pet učenika po prosjeku po svakoj školi.</h1>
                            <i class="far fa-file-alt fa-10x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>
        <script src="third-party/jquery/jquery-3.3.1.min.js"></script>
        <script src="third-party/bootstrap-4.1.3/js/bootstrap.min.js"></script>
        <script src="app.js"></script>
    </body>
</html>