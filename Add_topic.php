<?php
ini_set('display_error',0); 
session_start();
 if(!isset($_SESSION["teacherid"])) { header("Location: index.php"); }
$servername = "localhost";
$username = "root";
$password = "dhruv007";
$dbname = "e-learning";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM course";

$courses = $conn->query($sql);
if(isset($_POST['submit'])){
  $target_dir = "Documents/";
  $filename=time().'.'.pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
        $target_file = $target_dir .$filename;
        $image='';
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
  {
      $documnet=$filename;
  }else
  {
     $documnet='';
  }
  $Teacher_id=$_SESSION["teacherid"];
  $Topic_title=$_POST['Topic_title'];
  $Course=$_POST['Course'];
  $Description=$_POST['Description'];
  
  $Created=date("Y-m-d");
  $Updated=date("Y-m-d");;
  $sql = "INSERT INTO topics (Teacher_id, Topic_title, Course, Description,documnet, Created, Updated )
  VALUES ('$Teacher_id', '$Topic_title', '$Course','$Description', '$documnet', '$Created', '$Updated')";

  if ($conn->query($sql) === TRUE) {
      echo "New Topic has added successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Learning</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    /*footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }*/
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
    .navbar {
        position: relative;
        min-height: 94px;
        margin-bottom: 20px;
        border: 1px solid transparent;
    }
     .navbar-nav{
      margin-top: 40px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     <a class="navbar-brand" href="index.php"><img src="assets/logo.png" width="200px"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="index.php">Home</a></li>
        <li><a href="course.php">Courses</a></li>
       <?php if(!isset($_SESSION["teacherid"])) { ?>
          <li ><a href="registration.php">Teacher Registration</a></li>
        <?php }else{ ?>
           <li class="active"><a href="Add_topic.php">Add Topic</a></li>
        <?php } ?>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!isset($_SESSION["teacherid"])){ ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php }else{ ?>
           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Login Out</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- <h3>Latest Uploads </h3>
      <p><a href="#">Topic 1</a></p>
      <p><a href="#">Topic 2</a></p>
      <p><a href="#">Topic 3</a></p>
      <p><a href="#">Topic 4</a></p>
       -->
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Add Topic</h1>
      <hr>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="Title">Topic Title:</label>
          <input type="text" name="Topic_title" class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="course">Course:</label>
          <select name="Course" class="form-control">
            <option value="">Select Course</option>
            <?php 
              
              //var_dump($result->num_rows);die;
              if ($courses->num_rows > 0) {
                  // output data of each row
                  while($row = $courses->fetch_assoc()) { ?>
                    <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>

                <?php  }
              } 
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="Description">Description:</label>
          <textarea name="Description" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="fileToUpload">Documents / Notes Files :</label>
           <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
       
        <input type="submit" value="Submit" name="submit">
        
      </form>
    </div>
    <div class="col-sm-2 sidenav">
      <!-- <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div> -->
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright &copy; 2019</p>
</footer>

</body>
</html>
