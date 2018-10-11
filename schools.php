<?php
include_once('db-connection.php');

$current_file_name = basename($_SERVER['PHP_SELF']);

$db = new DB('root', '', 'records_of_students');
$db = $db->query('SELECT schools.school_id, schools.school_id, schools.school_name, schools.school_street, schools.school_telephone, schools.school_email, city.city_name FROM schools LEFT JOIN city ON schools.city_id=city.city_id');

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
        <title>Škole</title>
        <meta name="description" content="App for student grades">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="third-party/bootstrap-4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="third-party/fontawesome-free-5.3.1-web/css/all.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="body">
            <section class="page-header bg-secondary text-white mb-5 p-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb bg-light">
                                <li class="breadcrumb-item"><a href="index.php">Naslovnica</a></li>
                                <li class="breadcrumb-item active">Škole</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Škole</h1>
                        </div>
                    </div>
                </div>
            </section>
            <div id="body-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>r.br.</th>
                                            <th>Naziv</th>
                                            <th>Adresa</th>
                                            <th>Telefon</th>
                                            <th>E-mail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!empty((array) $db)) {
                                        $row_number = 0;
                                        foreach($db as $value) {
                                            $row_number++;
                                    ?>
                                        <tr>
                                            <td><?php echo $row_number; ?>.</td>
                                            <td><?php echo $value->school_name; ?></td>
                                            <td><?php echo $value->school_street . " " . $value->city_name; ?></td>
                                            <td><?php echo $value->school_telephone; ?></td>
                                            <td><?php echo $value->school_email; ?></td>
                                            <td>
                                                <?php echo "<a  class='btn btn-primary btn-sm btn-block' href='classes.php?school_id={$value->school_id}'>Vidi razrede</a>"; ?>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr"><td class="text-danger">Nema rezultata</td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
        <script src="third-party/jquery/jquery-3.3.1.min.js"></script>
        <script src="third-party/bootstrap-4.1.3/js/bootstrap.min.js"></script>
        <script src="third-party/fontawesome-free-5.3.1-web/js/all.js"></script>
        <script src="app.js"></script>
    </body>
</html>
