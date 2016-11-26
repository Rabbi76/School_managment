<!DOCTYPE html >

<html>
<head>

<?php

	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submit"]))
	{
		if (empty($_POST["name"]))
		{
			echo '<script language="javascript">';
			echo 'alert("Name is required")';
			echo '</script>';
		} else {
			$ti=$_POST["name"];
		}
		  
		if (empty($_POST["email"])) 
		{
			echo '<script language="javascript">';
			echo 'alert("Email is required")';
			echo '</script>';
		} else {
			$ty=$_POST["email"];
		}
			
		if (empty($_POST["comment"])) {
			echo '<script language="javascript">';
			echo 'alert("Comment is required")';
			echo '</script>';
		} else {
			$de=$_POST["comment"];
		}
		
		
		if(!empty($_POST["name"]) && !empty($_POST["email"]) & !empty($_POST["comment"]))
		{
			$connect = oci_connect("HR", "rat", "localhost/XE");
		
			$query = "insert into commentes values (null,'".$ti."','".$ty."',sysdate,'".$de."')";
			$stid = oci_parse($connect, $query);
			oci_execute($stid);
			
			echo '<script language="javascript">';
			echo 'alert("Comment Posted")';
			echo '</script>';
		}
		/*elseif(empty($_POST["name"]) && empty($_POST["email"]) & empty($_POST["comment"]))
		{
			echo '<script language="javascript">';
			echo 'alert("Sorry!! Something is wrong")';
			echo '</script>';
		}*/
		

		//echo $ti;
		//echo $ty;
		//echo $de;
	
		

		
	}
	
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submit2"]))
{
	$un=$_POST["user_name"];
	$pw=$_POST["password"];
	$co=0;
	
	$hand2=fopen("..\userlog\log.txt","a");
	
	$connect = oci_connect("HR", "rat", "localhost/XE");
	
    $query = "SELECT * FROM school_user_login WHERE user_name = :didbv and password = :didpw";
	$result = oci_parse($connect, $query);
	
	$didbv = $un;
	$didpw = $pw;

	oci_bind_by_name($result, ':didbv', $didbv);
	oci_bind_by_name($result, ':didpw', $didpw);
    
    oci_execute($result);
    
	if(($row = oci_fetch_array($result, OCI_BOTH)) != false) 
	{
		
	    if($row[2]=="admin")
		{	
			$_SESSION["login_user"]=$un;
			header("Location:..\user\admin\adminLogin.php");
			fwrite($hand2, "LOGGED BY--> ".$un ." - AT ". date("Y-m-d h:i:sa") .PHP_EOL);
		}
		else if($row[2]=="teacher")
		{
			$_SESSION["login_user"]=$un;
			header('Location:..\user\teacher\teacherLogin.php');
			fwrite($hand2, "LOGGED BY--> ".$un ." - AT ". date("Y-m-d h:i:sa") .PHP_EOL);
		}
		else if($row[2]=="parent")
		{
			$_SESSION["login_user"]=$un;
			header("Location:..\user\parent\parentLogin.php");
			fwrite($hand2, "LOGGED BY--> ".$un ." - AT ". date("Y-m-d h:i:sa") .PHP_EOL);
		}
		else if($row[2]=="student")
		{
			$_SESSION["login_user"]=$un;
			header("Location:..\user\student\studentLogin.php");
			fwrite($hand2, "LOGGED BY--> ".$un ." - AT ". date("Y-m-d h:i:sa") .PHP_EOL);
		}
	}
	
	else
		header("index.php");
}
	
	
?>

<title>School Manangment System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="../layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="../layout/scripts/jquery.slidepanel.setup.js"></script>
</head>
<body>
<div class="wrapper col0">
  <div id="topbar">
    <div id="slidepanel">
      <div class="topbox">
        <h2>User Login</h2>
        <p>If you are a valid user then login through the form. If you forget the user name or password contact the IT department. Thank a lot.</p>
      </div>
     
      <div class="topbox last">
        <h2>Login Here</h2>
         <form method="post">
			<fieldset>
				<legend>Login Form</legend>
				<label for="pupilname">Username:
				  <input type="text" name="user_name" id="pupilname" value="" />
				</label>
				<label for="pupilpass">Password:
				  <input type="password" name="password" id="pupilpass" value="" />
				</label>
				<label for="pupilremember">
				  <input class="checkbox" type="checkbox" name="pupilremember" id="pupilremember" checked="checked" />
				  Remember me</label>
				<p>
				  <input type="submit" name="submit2" id="pupillogin" value="Login" />
				  &nbsp;
				  <input type="reset" name="pupilreset" id="pupilreset" value="Reset" />
				</p>
			</fieldset>
        </form>
      </div>
      <br class="clear" />
    </div>
     <div id="loginpanel">
      <ul>
        <li class="left">Log In Here &raquo;</li>
        <li class="right" id="toggle"><a id="slideit" href="#slidepanel">Administration</a><a id="closeit" style="display:none;" href="#slidepanel">Close Panel</a></li>
      </ul>
    </div>  
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><a href="index.html">King's School & College</a></h1>
      <p>Education is life</p>
    </div>
    <div id="topnav">
      <ul>
        <li> <a href="../index.php">Home</a></li>
        <li ><a href="aca.php">Academics</a></li>
        <li ><a href="facility.php">Facilitis</a></li>
        <li><a href="teacherInfo.php">Teachers Info</a></li>
        <li class="active"><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">You Are Here</li>
      <li>&#187;</li>
      <li><a href="../index.php">Home</a></li>
      <li>&#187;</li>
      <li class="current"><a href="contact.php">Contact</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="homecontent">
    
      <div class="column2">
        <h2 align="center"> Address</h2>
			<br/>
			<h4 align="center"> 83/B, Road 4, Banani, Dhaka 1213, Bangladesh</h4>
			<h4 align="center">Phone:+8815386-7, +8811749</h4>
			<h4 align="center"> Website: info@king.edu</h4>
        <br class="clear" />
      </div>
      <div class="column2">
       </div>
    <br></br>
    <center><h2><strong>Write A Comment or Suggestion</strong></h2></center>
      <div id="respond">
        <form action="#" method="post">
          <p>
            <input type="text" name="name" id="name" value="" size="22" />
            <label for="name"><small>Name (required)</small></label>
          </p>
          <p>
            <input type="text" name="email" id="email" value="" size="22" />
            <label for="email"><small>Mail (required)</small></label>
          </p>
          <p>
            <textarea name="comment" id="comment" cols="100%" rows="10"></textarea>
            <label name="comment" style="display:none;"><small>Comment (required)</small></label>
          </p>
          <p>
            <input name="submit" type="submit" id="submit" value="Submit Form" />
          </p>
        </form>
      </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="footer">
    <div class="footbox">
      <h2>About</h2>
      <ul>
        <li><a href="#">Information</a></li>
        <li><a href="#">Why study here</a></li>
        <li><a href="#">Career</a></li>
        <li><a href="#">Our Goals</a></li>
        <li><a href="#">Picture</a></li>
        <li class="last"><a href="#">Video</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Academics</h2>
      <ul>
		<li><a href="#">Admission </a></li>
        <li><a href="#">Rules </a></li>
        <li><a href="#">Calender</a></li>
        <li><a href="#">Curiculam</a></li>
		<li class="last"><a href="#">Tuition fees</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Teacher Info</h2>
      <ul>
        <li><a href="#">Teacher List</a></li>
        <li><a href="#">Administration</a></li>
        <li><a href="#">Princple</a></li>
        <li class="last"><a href="#">Technical staff</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Our Patner</h2>
      <ul>
        <li><a href="#">Microsoft</a></li>
        <li><a href="#">Oracle</a></li>
        <li><a href="#">Sun Java</a></li>
        <li><a href="#">Cisco</a></li>
        <li><a href="#">FM 90.4</a></li>
        <li class="last"><a href="#">Prothom ALo</a></li>
      </ul>
    </div>
    <div class="footbox last">
      <h2>Quick Link</h2>
      <ul>
        <li><a href="#">Admission</a></li>
        <li><a href="#">Tuition fees</a></li>
        <li><a href="#">Academics Calender</a></li>
        <li><a href="#">Event</a></li>
        <li><a href="#">Academics Regulations</a></li>
        <li class="last"><a href="#">Office</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - King's School & College</p>
    <br class="clear" />
  </div>
</div>
</body>
</html>