<?php
include_once('db-connection.php');

$current_file_name = basename($_SERVER['PHP_SELF']);

if (isset($_GET["school_id"]) AND !empty($_GET["school_id"])){
    $school_id = $_GET["school_id"];

    if(ctype_digit($school_id)){
        $db = new DB('root', '', 'records_of_students');
        $db = $db->select('SELECT classes.class_id, classes.school_id, classes.class_name, classes.class_mark, teachers.teacher_name, teachers.teacher_surname, schools.school_name FROM classes LEFT JOIN teachers ON classes.teacher_id=teachers.teacher_id LEFT JOIN schools ON classes.school_id=schools.school_id WHERE classes.school_id = ?', array($_GET['school_id']), array('%d'));
    }else{
        header('Location: 404.php');
    }
}else{
    $school_id = "";
    $db = new DB('root', '', 'records_of_students');
    $db = $db->query('SELECT * FROM classes LEFT JOIN teachers ON classes.teacher_id=teachers.teacher_id LEFT JOIN schools ON classes.school_id=schools.school_id');
}

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
        <title>Razredi</title>
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
                                <li class="breadcrumb-item"><a href="schools.php">Škole</a></li>
                                <li class="breadcrumb-item active">Razredi<?php if (!empty((array)$db) AND !empty($school_id)) { echo ": " .$db[0]->school_name; } ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Razredi<?php if (!empty((array)$db) AND !empty($school_id)) { echo ": " .$db[0]->school_name; } ?></h1>
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
                                            <th>Razred</th>
                                            <th>Škola</th>
                                            <th>Razrednik</th>
                                            <th>Opcije</th>
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
                                            <td><?php echo $value->class_name . " " . $value->class_mark; ?></td>
                                            <td><?php echo $value->school_name; ?></td>
                                            <td><?php echo $value->teacher_name . " " . $value->teacher_surname; ?></td>
                                            <td>
                                                <?php echo "<a  class='btn btn-primary btn-sm btn-block' href='students.php?school_id={$value->school_id}&class_id={$value->class_id}'>Vidi učenike</a>"; ?>
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
