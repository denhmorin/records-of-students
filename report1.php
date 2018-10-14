<?php
error_reporting(0);
include_once("db-connection.php");

$db = new DB('root', '', 'records_of_students');

$db1 = $db->query('SELECT schools.school_id, schools.school_name FROM schools');
$school_with_students = array();
$schools = array();
foreach($db1 as $value) {
    $db2 = $db->select('SELECT count(students.student_id) AS students_count, ROUND(AVG(students.student_grade),2) as average_grade FROM students INNER JOIN classes ON students.class_id = classes.class_id  WHERE classes.school_id = ?', array($value->school_id), array('%d'));
    $schools["school"] = $value->school_name;

    foreach($db2 as $value2) {
        $schools["students_count"] = $value2->students_count;
        $schools["average_grade"] = $value2->average_grade;
    }

    array_push($school_with_students,$schools);
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
        <title>Škole - Broj učenika po školi i prosječna ocjena po školi.</title>
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
                                <li class="breadcrumb-item active">Broj učenika po školi i prosječna ocjena po školi.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Broj učenika po školi i prosječna ocjena po školi.</h1>
                        </div>
                    </div>
                </div>
            </section>
            <div id="body-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>R.br.</th> 
                                            <th>Škola</th>
                                            <th>Broj učenika</th>
                                            <th>Prosječna ocjena</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $row_number = 0;
                                    foreach ($school_with_students as $value) { 
                                        if(!empty($school_with_students)){
                                            $row_number++;
                                    ?>
                                            <tr> 
                                                <td><?php echo $row_number; ?></td> 
                                                <td><?php echo $value['school']; ?></td>  
                                                <td>
                                                <?php 
                                                    if(!empty($value['students_count'])){
                                                        echo $value['students_count'];
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                                </td>  
                                                <td>
                                                <?php 
                                                    if(!empty($value['average_grade'])){
                                                        echo $value['average_grade'];
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }else{
                                            echo "<tr><td>Nema rezultata</td></tr>";
                                        }
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
    </body>
</html>
