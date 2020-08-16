<?php 
session_start();
 if(isset($_SESSION["teacherid"])) { header("Location: index.php"); }
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
if(isset($_POST['submit'])){
  $Name=$_POST['Name'];
  $e_mail=$_POST['e_mail'];
  $Password=md5($_POST['Password']);
  $Address=$_POST['Address'];
  $Qualification=$_POST['Qualification'];
  $Contact=$_POST['Contact'];
  $Created=date("Y-m-d");
  $Updated=date("Y-m-d");;
  $sql = "INSERT INTO teacher (Name, e_mail, Password, Address, Qualification, Contact, Created, Updated )
  VALUES ('$Name', '$e_mail', '$Password','$Address', '$Qualification', '$Contact', '$Created', '$Updated')";

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
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
        <li class="active"><a href="registration.php">Teacher Registration</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
      <h1>Teacher Registration</h1>
      <hr>
      <form action="" method="POST" name="registrationform">
      <div class="form-group">
          <label for="name">Full Name:</label>
          <input type="text" class="form-control" id="name" name="Name" required>
        </div>
        <div class="form-group">
          <label for="email">Email ID:</label>
          <input type="email" class="form-control" id="email" name="e_mail" required>
        </div>
        <div class="form-group">
          <label for="Password">Password:</label>
          <input type="Password" class="form-control" id="Password" name="Password" required>
        </div>
        <div class="form-group">
          <label for="Address">Address:</label>
          <input type="text" class="form-control" id="Address" name="Address">
        </div>
        <div class="form-group">
          <label for="Qualification">Qualification (Seprate by ','):</label>
          <input type="text" class="form-control" id="Qualification" name="Qualification" required>
        </div>
        <div class="form-group">
          <label for="Contact">Contact:</label>
          <input type="text" class="form-control" id="Contact" name="Contact" >
        </div>
         
        <input type="submit" name="submit" class="btn btn-default" value="Submit">  
      </form>
      <hr>
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
