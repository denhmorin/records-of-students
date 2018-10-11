<?php
include_once("db-connection.php");
error_reporting( error_reporting() & ~E_NOTICE);
/*ini_set('display_errors', 'On');
error_reporting(E_ALL);*/
if (isset($_GET["student_id"]) AND !empty($_GET["student_id"])){
    $student_id = $_GET["student_id"];
    if(!ctype_digit($student_id)){
       header('Location: 404.php'); 
    }
}
$id_update_student = $student_id;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["submit"])){
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        $student_name = test_input($_POST["student_name"]);
        $student_surname = test_input($_POST["student_surname"]);
        $student_image = test_input($_POST["student_image"]);
        $student_oib = test_input($_POST["student_oib"]);
        $student_telephone = test_input($_POST["student_telephone"]);
        $student_street = test_input($_POST["student_street"]);
        $city_id = test_input($_POST["city_id"]);
        $class_id = test_input($_POST["class_id"]);
        $student_email = test_input($_POST["student_email"]);
        $student_grade = test_input($_POST["student_grade"]);
        $student_status = test_input($_POST["student_status"]);
        if(empty($student_name)){
            $error_student_name = "Unesite ime.";
        }
        if(empty($student_surname)){
            $error_student_surname = "Unesite Prezime.";
        }
        if(empty($student_oib)){
            $error_student_oib = "Unesite OIB.";
        }
        if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
           $error_student_email = "Morate unijeti ispravnu E-mail adresu"; 
        }
        $msg = "";
        if(!isset($_FILES['student_image']) || $_FILES['student_image']['error'] == UPLOAD_ERR_NO_FILE){
            if (isset($_GET['student_id']) AND !empty($_GET['student_id'])){
                $sql = "SELECT students.student_image FROM students WHERE student_id =".$id_update_student;
                $result = doQuery($conn,$sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_array()) {
                        $student_image = $row["student_image"];
                    }
                }
            }
        }else{  
            $file_name = $_FILES['student_image']['name'];
            $file_size = $_FILES['student_image']['size'];
            $file_tmp = $_FILES['student_image']['tmp_name'];
            $file_type = $_FILES['student_image']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['student_image']['name'])));
            $expensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$expensions)=== false){
                $error_student_image = "Format slike nije dozvoljen, molim učitajte JPG ili PNG format.<br/>";
            }
            if($file_size > 2097152) {
                $error_student_image .= "Veličina slike mora biti manja od 2 MB.<br/>";
            }
            if(empty($error_student_image)==true) {
                move_uploaded_file($file_tmp,"img/".$file_name);
                $student_image = "img/".$file_name;
            } 
        }
        
        if(empty($error_student_name) AND empty($error_student_surname) AND empty($error_student_oib) AND empty($error_student_email) AND empty($error_student_image)){
            if (!empty($id_update_student)){
                $msg = "Uspješno ste ažurirali učenika";
                $sql = "UPDATE students SET student_name='".$student_name."', student_surname='".$student_surname."', student_image='".$student_image."', student_oib='".$student_oib."', student_telephone='".$student_telephone."', student_street='".$student_street."', city_id=".$city_id.", student_email='".$student_email."', student_grade=".$student_grade.", student_status=".$student_status." , class_id=".$class_id." WHERE student_id =".$id_update_student;
                doQuery($conn,$sql);
            } else {
                $sql = "INSERT INTO students (student_name, student_surname, student_image, student_oib, student_telephone, student_street, city_id, student_email, student_grade, student_status, class_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                if($stmt = $conn->prepare($sql)){
                    $stmt->bind_param('sssddsdsddd', $student_name, $student_surname, $student_image, $student_oib, $student_telephone, $student_street, $city_id, $student_email, $student_grade, $student_status, $class_id);
                    $stmt->execute();
                    $stmt->close();
                }
                $msg = "Uspješno ste dodali novog učenika";
            }
        }
    }
}
if(isset($_GET["student_delete"]) AND !empty($_GET["student_delete"])){
    $student_delete =  $_GET["student_delete"];
        $sql = "DELETE FROM records_of_students.students WHERE students.student_id = " . $student_delete;
        doQuery($conn,$sql);
}
if(!empty($id_update_student)){
    $sql = "SELECT students.student_id, students.student_image, students.student_name, students.student_surname, students.student_oib, students.student_street, students.student_grade, students.student_status, students.student_email, students.student_telephone FROM students WHERE student_id={$id_update_student}";
            $result = doQuery($conn,$sql);
            $result_student = mysqli_fetch_array($result);
}
$sql = "SELECT * FROM city";
$city = doQuery($conn,$sql);
$sql = "SELECT classes.class_id, classes.class_name, schools.school_id, schools.school_name FROM classes LEFT JOIN schools ON classes.school_id=schools.school_id";
$classes = doQuery($conn,$sql);
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
        <title>Učenici</title>
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
                                <li class="breadcrumb-item"><a href="classes.php">Razredi</a></li>
                                <li class="breadcrumb-item"><a href="students.php">Učenici</a></li>
                                <li class="breadcrumb-item active">Editiranje učenika</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Učenici</h1>
                        </div>
                    </div>
                </div>
            </section>
            <div id="body-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-primary mb-4" href="student-edit.php">Dodaj novog učenika</a>
                            <h2 class="text-primary"><?php if(!empty($msg)){echo $msg;} ?></h2>
                            <form name="student-edit-form" id="student-edit-form" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?student_id=".$id_update_student); ?>" >
                                <div class="form-group">
                                    <label for="student_image">Slika:</label>
                                    <p class="text-danger d-inline small"> <?php echo $error_student_image; ?></p>
                                    <?php
                                        if (!empty($result_student["student_image"])){
                                            echo '<br><img class="student-photo" src="'.$result_student["student_image"].'" />';
                                        }else {
                                            echo '<br><img class="student-photo" src="img/user.png"/>';
                                        }
                                    ?>
                                    <input class="form-control" name="student_image" id="student_image" accept="img/*" type="file" value="<?php if(!empty($result_student["student_image"])){echo $result_student["student_image"];} ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="student_name">*Ime:</label>
                                    <p class="text-danger d-inline small"> <?php echo $error_student_name; ?></p>
                                    <input class="form-control" name="student_name" id="student_name" type="text" maxlength="120" value="<?php if(!empty($result_student["student_name"])){echo $result_student["student_name"];} ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="student_surname">*Prezime:</label>
                                    <p class="text-danger d-inline small"> <?php echo $error_student_surname; ?></p>
                                    <input class="form-control" name="student_surname" id="student_surname" type="text" maxlength="120" value="<?php if(!empty($result_student["student_surname"])){echo $result_student["student_surname"];} ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="student_oib">*OIB:</label>
                                    <p class="text-danger d-inline small"> <?php echo $error_student_oib; ?></p>
                                    <input class="form-control" pattern="^[0-9]*$" name="student_oib" id="student_oib" type="text" minlength="13" maxlength="13" value="<?php if(!empty($result_student["student_oib"])){echo $result_student["student_oib"];} ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="student_telephone">Telefon:</label>
                                    <input class="form-control" name="student_telephone" id="student_telephone" type="text" maxlength="30" value="<?php if(!empty($result_student["student_telephone"])){echo $result_student["student_telephone"];} ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="student_street">Ulica:</label>
                                    <input class="form-control" name="student_street" id="student_street" type="text" maxlength="120" value="<?php if(!empty($result_student["student_street"])){echo $result_student["student_street"];} ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="city_id">Grad:</label>
                                    <select class="form-control" name="city_id" id="city_id">
                                    <?php
                                        while($row = mysqli_fetch_array($city)){
                                            echo "<option value=\"".$row["city_id"]."\"";
                                            if(!empty($result_student["city_id"]) AND $result_student["city_id"] == $row["city_id"]) {
                                                echo " selected=\"selected\" ";
                                            }
                                            echo ">".$row["city_name"]."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="class_id">Razred:</label>
                                    <select class="form-control" name="class_id" id="class_id">
                                    <?php
                                        while($row = mysqli_fetch_array($classes)){
                                            echo "<option value=\"".$row["class_id"]."\"";
                                            if(!empty($result_student["class_id"]) AND $result_student["class_id"] == $row["class_id"]) {
                                                echo " selected=\"selected\" ";
                                            }
                                            echo ">".$row["school_name"]. " - " .$row["class_name"]." razred</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student_email">E-mail:</label>
                                    <p class="text-danger d-inline small"> <?php echo $error_student_email; ?></p>
                                    <input class="form-control" name="student_email" id="student_email" type="email" maxlength="50" value="<?php if(!empty($result_student["student_email"])){echo $result_student["student_email"];} ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="student_grade">Prosječna ocjena:</label>
                                    <input class="form-control" name="student_grade" id="student_grade" type="number" min="1" max="5" step="0.01" value="<?php if(!empty($result_student["student_grade"])){echo $result_student["student_grade"];} ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="student_status">*Status:</label><br>
                                    <input type="radio" name="student_status" value="1" <?php if(!empty($result_student['student_status']) AND $result_student['student_status'] == 1){echo "checked";} ?> required> Aktivan<br>
                                    <input type="radio" name="student_status" value="0" <?php if(isset($result_student['student_status']) AND $result_student['student_status'] == 0){echo "checked";} ?> required> Neaktivan<br>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Spremi">
                                    <input type="reset" class="btn btn-basic" value="Očisti formu">
                                    <?php 
                                    if(!empty($id_update_student)){
                                    echo '<a class="btn btn-danger" onclick="return confirm(\'Jeste li sigurni da želite obrisati učenika?\');" href="student-edit.php?student_delete=<?php echo $result_student["student_id"];?>Obriši učenika</a>';
                                    }
                                    ?>
                                </div>
                            </form>
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