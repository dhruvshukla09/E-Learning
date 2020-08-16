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
  
  $e_mail=$_POST['e_mail'];
  $Password=md5($_POST['Password']);
  
  
  $sql = "SELECT * FROM teacher where e_mail ='$e_mail' and Password = '$Password'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
       
        $_SESSION["teacherid"] =  $row["Id"];
        $_SESSION["tname"] = $row["Name"];
        $_SESSION["te_mail"] = $row["e_mail"];
        $_SESSION["tAddress"] = $row["Address"];
        $_SESSION["tQualification"] = $row["Qualification"];
        $_SESSION["tContact"] = $row["Contact"];
        
        if($_SESSION["teacherid"]){
          header("Location: index.php");
        }
        
         //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      }
  } else {
      echo "invalid username Password";
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
    }
    */
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
        <li><a href="registration.php">Teacher Registration</a></li>
        <li ><a href="contact.php">Contact</a></li>
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
      <h1>Teacher Login</h1>
      <hr>
      <form action="" method="POST" name="Loginform">
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" name="e_mail" class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" name="Password" class="form-control" id="pwd">
        </div>
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
        <input type="submit" name="submit" class="btn btn-default" value="Submit" >
      </form>
      <hr>
      <h3>Test</h3>
      <p>Lorem ipsum...</p>
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
