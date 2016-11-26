<!DOCTYPE html >


<head>
<?php
		session_start();
	$un="";
	$pw="";
	
if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submit"]))
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
				  <input type="submit" name="submit" id="pupillogin" value="Login" />
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
        <li class="active"><a href="facility.php">Facilitis</a></li>
        <li><a href="teacherInfo.php">Teachers Info</a></li>
        <li><a href="contact.php">Contact</a></li>
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
      <li class="current"><a href="facility.php">Facilitis</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="homecontent">
    <div class="fl_left">
      <div class="column2">
        <ul>
          <li>
            <h2> Auditorium</h2>
			<img style="width:250px;height:150px" src="../images/home/auditorium.jpg" alt="" />
			<p style="font-size:15px">The auditorium serves as an activity room for extra curricular activities. The auditorium can hold 500 people. The auditorium is used to hold seminars, meetings, also for special classes, Business Presentation and the like. It is equipped with state of the art facilities</p>
        </li>
          <li class="last">
           <h2> Classrooms</h2>
		   <img style="width:250px;height:150px" src="../images/home/classroom.jpg" alt="" />
			<p style="font-size:15px">All Rooms are equipped with a laptop, modern whiteboard, audio facilities, comfortable chairs and spacious study tables. Almost all rooms have a modern, short throw projector installed for presentations and videos. Self-study facilities include a wide range of practice materials including a library of language books and graded readers, videos, computer facilities to access Leeds English Online, exam practice materials such as IELTS and FCE and much more.</p>
          </li>
        </ul>
        <br class="clear" />
      </div>
      <div class="column2">
        <h2> Library Facilities</h2>
		<img style="width:450px;height:150px" src="../images/home/library.jpg" alt="" />
        <p style="font-size:15px">The library of school is the collection of the knowledge and built up a balanced and rich collection in all classes. It is an open library system, which provides rich collection of books including journals, newsletter, thesis works, audio-visual materials and CD's. The total collection of the library is about 50,000 including printed and unprinted resources. The library can accommodate more than 1000 students at a time. </p>
      </div>
    </div>
    <div class="fl_right">
      <h2>Lab Facilities</h2>
	  <img style="width:300px;height:150px" src="../images/home/comlab.jpg" alt="" />
      <p style="font-size:15px">Information Communication Technology provides general-access computing and communications facilities for the entire University community, including a high-speed campus network linked to the Internet, computing labs, and central e-mail services. Information Communication Technology (ICT) department manages the school computing facilities. We have ten  powerful server configured on different platform such as Windows AS/2000, Linux, AIX-Windows, and OS/400. </p>
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