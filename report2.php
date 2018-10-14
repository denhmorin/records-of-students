<?php
error_reporting(0);

include_once("db-connection.php");

$db = new DB('root', '', 'records_of_students');

/*students and average grade by classes*/
$school_with_students1 = array();
$schools1 = array();
$db1 = $db->query('SELECT *, count(students.student_id) AS students_count, ROUND(AVG(students.student_grade),2) AS average_grade FROM students RIGHT JOIN classes ON students.class_id=classes.class_id GROUP BY class_name ORDER BY class_name ASC');

foreach($db1 as $value1) {
    $schools1["class_name"] = $value1->class_name;
    $schools1["students_count"] = $value1->students_count;
    $schools1["average_grade"] = $value1->average_grade;
    array_push($school_with_students1,$schools1);
}

/*students and average grade by schools and classes*/
$db2 = $db->query('SELECT schools.school_id, schools.school_name FROM schools');
$school_with_students2 = array();
$schools2 = array();
foreach($db2 as $value2) {
    $db3 = $db->select('SELECT classes.class_name, count(students.student_id) AS students_count, ROUND(AVG(students.student_grade),2) AS average_grade FROM students RIGHT JOIN classes ON students.class_id=classes.class_id WHERE classes.school_id = ? GROUP BY class_name ORDER BY class_name ASC', array($value2->school_id), array('%d'));
    $schools2["school"] = $value2->school_name;
    $students2 = array();
    foreach($db3 as $value3) {
       array_push($students2, $value3);
    }
    $schools2["students"] = $students2;
    array_push($school_with_students2,$schools2);
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
        <title>Škole - Broj učenika po razredima i prosječna ocjena po razredu.</title>
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
                                <li class="breadcrumb-item active">Broj učenika po razredima i prosječna ocjena po razredu.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Broj učenika po razredima i prosječna ocjena po razredu.</h1>
                        </div>
                    </div>
                </div>
            </section>
            <div id="body-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="tabs">
                                <ul class="nav nav-pills mb-5">
                                    <li class="nav-item">
                                        <a href="#classes" data-toggle="pill" class="nav-link active">Ocjene po razredima</a>
                                    </li>
                                    <li>
                                        <a href="#schools" data-toggle="pill" class="nav-link">Ocjene po razredima u školama</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="classes" class="tab-pane active">
                                         <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>R.br.</th> 
                                                        <th>Razred</th>
                                                        <th>Broj učenika</th>
                                                        <th>Prosječna ocjena</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                $row_number = 0;
                                                foreach ($school_with_students1 as $value) { 
                                                    if(!empty($school_with_students1)){
                                                        $row_number++;
                                                ?>
                                                        <tr> 
                                                            <td><?php echo $row_number; ?></td> 
                                                            <td><?php echo $value['class_name']; ?></td>  
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
                                    <div id="schools" class="tab-pane">
                                        <div class="row">
                                        <?php 
                                        if ($school_with_students2 != null) { 
                                            foreach ($school_with_students2 as $value) { 
                                        ?>
                                            <div class="col-sm-12">
                                                <h3><?php echo $value['school'] ?> </h3>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>R.br.</th> 
                                                                <th>Razred</th>
                                                                <th>Broj učenika</th>
                                                                <th>Prosječna ocjena</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        if($value['students']){
                                                            $row_number = 0;
                                                            foreach ($value['students'] as $value2) {
                                                            $row_number++;
                                                        ?>
                                                            <tr> 
                                                                <td><?php echo $row_number; ?></td> 
                                                                <td><?php echo $value2->class_name; ?></td>  
                                                                <td>
                                                                <?php 
                                                                    if(!empty($value2->students_count)){
                                                                        echo $value2->students_count;
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                ?>
                                                                </td>  
                                                                <td>
                                                                <?php 
                                                                    if(!empty($value2->average_grade)){
                                                                        echo $value2->average_grade;
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            }
                                                        }else{
                                                            echo '<tr"><td colspan="4" class="text-danger">Nema rezultata</td></tr>';
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
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
