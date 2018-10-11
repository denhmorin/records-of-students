<?php
include_once("db-connection.php");

$current_file_name = basename($_SERVER['PHP_SELF']);

if (isset($_GET["school_id"]) AND !empty($_GET["school_id"]) AND isset($_GET["class_id"]) AND !empty($_GET["class_id"])){
    $school_id = $_GET["school_id"];
    $class_id = $_GET["class_id"];
    if(!ctype_digit($school_id) OR !ctype_digit($class_id)){
       header('Location: 404.php'); 
    }else{
        $db = new DB('root', '', 'records_of_students');
        $db = $db->select('SELECT students.student_id, students.student_image, students.student_name, students.student_surname, students.student_oib, students.student_street, students.student_grade, students.student_status, city.city_name, classes.class_name, classes.class_mark, schools.school_name FROM students LEFT JOIN city ON students.city_id=city.city_id LEFT JOIN classes ON students.class_id=classes.class_id  LEFT JOIN schools ON classes.school_id=schools.school_id WHERE students.class_id = ?', array($class_id), array('%d'));
    }
}
else{
    $class_id = "";
    $db = new DB('root', '', 'records_of_students');
    $db = $db->query('SELECT students.student_id, students.student_image, students.student_name, students.student_surname, students.student_oib, students.student_street, students.student_grade, students.student_status, city.city_name FROM students LEFT JOIN city ON students.city_id=city.city_id');
}

if(isset($_GET["student_delete"]) AND !empty($_GET["student_delete"])){
    $student_delete =  $_GET["student_delete"];
        $sql = "DELETE FROM records_of_students.students WHERE students.student_id = " . $student_delete;
        doQuery($conn,$sql);
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
                                <li class="breadcrumb-item active">Učenici
                                <?php 
                                    if (!empty((array)$db) AND !empty($class_id)) { echo ": " .$db[0]->class_name . "" . $db[0]->class_mark; } 
                                    if (!empty((array)$db) AND !empty($school_id)) { echo " / " .$db[0]->school_name; }
                                ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Učenici
                            <?php 
                                if (!empty((array) $db) AND !empty($class_id)) { echo ": " .$db[0]->class_name . "" . $db[0]->class_mark; } 
                                if (!empty((array) $db) AND !empty($school_id)) { echo " / " .$db[0]->school_name; }
                            ?>
                            </h1>
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
                                            <th>Slika</th>
                                            <th>Ime</th>
                                            <th>Prezime</th>
                                            <th>OIB</th>
                                            <th>Adresa</th>
                                            <th>Prosječna ocjena</th>
                                            <th>Status</th>
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
                                            <td><img src="<?php if(!empty($value->student_image)){echo $value->student_image; }else{ echo "img/user.png"; } ?>" class="student-photo" /></td>
                                            <td><?php echo $value->student_name; ?></td>
                                            <td><?php echo $value->student_surname; ?></td>
                                            <td><?php echo $value->student_oib; ?></td>
                                            <td><?php echo $value->student_street . ", " . $value->city_name; ?></td>
                                            <td><?php echo $value->student_grade; ?></td>
                                            <td>
                                            <?php 
                                                if ($value->student_status == 1){
                                                    echo "Aktivan";
                                                }elseif($value->student_status == 0){
                                                    echo "Neaktivan";
                                                }
                                            ?>
                                                
                                            </td>
                                            <td>
                                                <?php echo "<a  class='btn btn-primary btn-sm btn-block' href='student-edit.php?student_id={$value->student_id}'>Uredi</a>"; ?>
                                                <a class="btn btn-danger btn-sm btn-block" onclick="return confirm('Jeste li sigurni da želite obrisati učenika?');" href="students.php?student_delete=<?php echo $value->student_id;?>">Obriši učenika</a>
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
