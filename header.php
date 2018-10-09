<header>
	<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
		<div class="container-fluid">
		  <a class="navbar-brand mb-0 h1" href="index.php">Ocjene učenika</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" class="<?php if($current_file_name == "index.php"){echo "active";} ?>" href="index.php">Naslovnica <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" class="<?php if($current_file_name == "schools.php" OR $current_file_name == "student-edit.php"){echo "active";} ?>" href="schools.php">Škole</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" class="<?php if($current_file_name == "classes.php"){echo "active";} ?>" href="classes.php">Razredi</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" class="<?php if($current_file_name == "students.php"){echo "active";} ?>" href="students.php">Učenici</a>
		      </li>
		    </ul>
		  </div>
		</div>
	</nav>
</header>