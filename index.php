<?php session_start();
$course=(isset($_REQUEST['courses']))? $_REQUEST['courses']: '';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-learning";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM topics order by Id desc limit 10 ";

$topics = $conn->query($sql);

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
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="course.php">Courses</a></li>
        <?php if(isset($_SESSION["teacherid"])) { ?>
          <li><a href="Add_topic.php">Add Topic</a></li>
        <?php }else{ ?>
          <li><a href="registration.php">Teacher Registration</a></li>
           
        <?php } ?>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION["teacherid"])){ ?>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Login Out</a></li>
        <?php }else{ ?>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
           
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <h3>Latest Uploads </h3>
      <?php 
              
          //var_dump($result->num_rows);die;
          if ($topics->num_rows > 0) {
              // output data of each row
              while($row = $topics->fetch_assoc()) { ?>
                <p><a href="topic_detail.php?topic=<?php echo $row['Id']; ?>"><?php echo $row['Topic_title']; ?></a></p>
                

            <?php  }
          } 
        ?>
      
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Welcome to e-learning</h1>
      <p>We believe that learners can thrive in digital classrooms that are engaging, learning-focused and inclusive. The e-scholar is a leader in the development and delivery of innovative digital learning experiences. We offer a wide variety of online learning opportunities for  students to participate in continuous learning, communication and collaboration.</p>
      <p>e-Learning provides students with learning experiences that are:</p>
      <p>flexible: students can learn anytime, anywhere</p>
      <p>relevant: students prepare for their future in an increasingly digital world</p>
      engaging: students enjoy rich, interactive online content</p>
      
      <h2>Learn on your own schedule</h2>
      <h4>Study any topic,anytime.</h4>

      <h3>e-learning Information</h3>
      <p>e-Learning courses have been developed by the Ministry of Education and are delivered by professional teachers.</p>
      <p>Students can read the documnent anytime they want uploaded by the teachers and refer it for their own purposes.</p>




      <hr>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright &copy; 2019</p>
</footer>

</body>
</html>
