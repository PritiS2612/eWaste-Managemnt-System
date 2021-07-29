<?php
error_reporting();
include('config.php');
// fetching admin email where mail will send
$sql ="SELECT emailId from tblemail";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0):
foreach($results as $result):
$adminemail=$result->emailId;
endforeach;
endif;
if(isset($_POST['submit']))
{
// getting Post values	
$name=$_POST['name'];
$phoneno=$_POST['phonenumber'];
$email=$_POST['emailaddres'];
$message=$_POST['message'];
$uip = $_SERVER ['REMOTE_ADDR'];
$isread=0;
// Insert quaery
$sql="INSERT INTO  tblpickupdata(FullName,PhoneNumber,EmailId,Message,UserIp,Is_Read) VALUES(:fname,:phone,:email,:message,:uip,:isread)";
$query = $dbh->prepare($sql);
// Bind parameters
$query->bindParam(':fname',$name,PDO::PARAM_STR);
$query->bindParam(':phone',$phoneno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':uip',$uip,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
//mail function for sending mail
$to=$email.",".$adminemail; 
$headers .= "MIME-Version: 1.0"."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:eWaste Management System Demo<info@pritiewms.com>'."\r\n";
$ms.="<html></body><div>
<div><b>Name:</b> $name,</div>
<div><b>Phone Number:</b> $phoneno,</div>
<div><b>Email Id:</b> $email,</div>";
$ms.="<div style='padding-top:8px;'><b>Message : </b>$message</div><div></div></body></html>";
mail($to,$ms,$headers);




echo "<script>alert('Your info submitted successfully.');</script>";
  echo "<script>window.location.href='index.php'</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
  echo "<script>window.location.href='index.php'</script>";
}


}


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Schedule a Pickup</title>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>e-Waste Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/ew.jpg" rel="icon">
  <link href="assets/img/ew.jpg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

 <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Josefin+Sans:400,100,300,600,700' rel='stylesheet' type='text/css'>
<!--web-fonts-->
<style type="text/css">
	.btn-learn-more {
  font-family: "Raleway", sans-serif;
  font-weight: 600;
  font-size: 14px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 32px;
  border-radius: 5px;
  transition: 0.3s;
  line-height: 1;
  color: #006fbe;
  -webkit-animation-delay: 0.8s;
  animation-delay: 0.8s;
  margin-top: 6px;
  border: 2px solid #006fbe;
}

.btn-learn-more:hover {
  background: #006fbe;
  color: #fff;
  text-decoration: none;
}
    .pick{
    display: inline-block;
    padding: 10px 15px;
    font-size: 24px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline: none;
    color: #fff;
    background-color: #7FFFD4;
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px #5F9EA0;
  }
  .pick:hover {
    background-color: #adff2f;
  }
  .pick:active{
    background-color: #adff2f;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }
  </style>


</head>
<body>
      
	<!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">e-Waste Management System</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!--a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="our-story.php">About e-Waste</a></li>
          <li><a href="service.php">Services</a></li>
          <li><a href="Process.php">Process</a></li>
          <li><a href="contact.php">Contact Us</a>
          </li>
          <li><a href="admin/index.php">Dashboard</a></li>
          <li class="active"><a href="pickup.php" class="pick">Schedule a Pickup</a></li>
        </ul>


        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
<!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs" style="padding-top:50px";>
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Schedule a Pickup</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Schedule a Pickup</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

		<!---header--->
		<div class="header">
      
			<h1>Schedule a Pickup</h1>
		</div>
		<!---header--->
		<!---main--->
			<div class="main">
				<div class="main-section">
				<div class="login-form">
					<h2>Scheduling a Pickup is easy</h2>
					<p>Fill out the form for us and we will get back to you with a confirmation email</p>
						<span></span>
					<form name="ContactForm" method="post">

<h4>your name</h4>
<input type="text" name="name" class="user" placeholder="Johne"  autocomplete="off" required>

<h4>your phone number</h4>
<input type="text" name="phonenumber" class="phone" placeholder="0900.234.145678" maxlength="10" required autocomplete="off">

<h4>your email address</h4>
<input type="email" name="emailaddres" class="email" placeholder="Example@mail.com" required autocomplete="off">

<h4>Comment or Message for our Pick-up Executives</h4>
<textarea class="mess" name="message" placeholder="Message" required></textarea>
<input type="submit" value="send your Schedule" name="submit">
</form>
				
				</div>
				</div>
			</div>
			  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>eWaste Management System</h3>
      <p>Go Green and Spread Greenary all over the Earth.</p>
      <div class="social-links">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>eWaste Mangement System</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        Designed by <a href="#">Priti Singh</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

		<!---main--->
</body>
</html>