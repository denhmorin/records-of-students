<?php
include_once("db-connection.php");


$current_file_name = basename($_SERVER['PHP_SELF']);
if (isset($_GET["school_id"]) AND !empty($_GET["school_id"])){
    $school_id = $_GET["school_id"];

    if(ctype_digit($school_id)){
        $sql = "SELECT classes.class_id, classes.class_name, classes.class_mark, teachers.teacher_name, teachers.teacher_surname FROM classes LEFT JOIN teachers ON classes.teacher_id=teachers.teacher_id WHERE school_id={$school_id}";
        $result = doQuery($conn,$sql);

        $sql = "SELECT schools.school_id, schools.school_name FROM schools WHERE school_id = {$school_id}";
        $result1 = doQuery($conn,$sql);
        $result_complete = mysqli_fetch_array($result1);
    }else{
        header('Location: 404.php');
    }
}else{
    $sql = "SELECT classes.class_id, classes.class_name, classes.class_mark, teachers.teacher_name, teachers.teacher_surname, schools.school_id, schools.school_name FROM classes LEFT JOIN schools ON classes.school_id=schools.school_id LEFT JOIN teachers ON classes.teacher_id=teachers.teacher_id";
    $result = doQuery($conn,$sql);
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
                                <li class="breadcrumb-item active">Razredi<?php if (isset($result_complete) AND !empty($result_complete)){ echo ": " .$result_complete['school_name']; } ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Razredi<?php if (isset($result_complete) AND !empty($result_complete)){ echo ": " .$result_complete['school_name']; } ?></h1>
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
                                            <th>R.br.</th>
                                            <th>Razred</th>
                                            <th>Škola</th>
                                            <th>Razrednik</th>
                                            <th>Opcije</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        $row_number = 0;
                                        while($row = $result->fetch_array()) {
                                            $row_number++;
                                    ?>
                                        <tr>
                                            <td><?php echo $row_number; ?>.</td>
                                            <td><?php echo $row['class_name'] . " " . $row['class_mark']; ?></td>
                                            <td>
                                            <?php 
                                                if(isset($result_complete) AND !empty($result_complete)){
                                                    echo $result_complete['school_name'];
                                                }else{
                                                    echo $row['school_name'];
                                                }
                                             ?>
                                            </td>
                                            <td><?php echo $row['teacher_name'] . " " . $row['teacher_surname']; ?></td>
                                            <td>
                                                <?php
                                                if(empty($school_id)){
                                                    $school_id = $row['school_id'];
                                                }
                                                 echo '<a href="students.php?class_id=' . $row["class_id"] . '&school_id=' . $school_id. '" class="btn btn-primary btn-block btn-sm">Vidi učenike <i class="fas fa-chevron-right" style="color: #fff;"></i></a></td>';?></td>
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
