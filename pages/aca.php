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
        <li class="active"><a href="pages/aca.php">Academics</a></li>
        <li><a href="facility.php">Facilitis</a></li>
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
      <li class="current"><a href="aca.php">Academics</a></li>
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
            <h2>About School</h2>
            <div class="imgholder"><img src="../images/home/school2.jpg" alt="" /></div>
            <p>The Cleveland Metropolitan School District envisions 21st Century Schools of Choice where students will be challenged with a rigorous curriculum that considers the individual learning styles, program preferences and academic capabilities of each student, while utilizing the highest quality professional educators, administrators and support staff available. </p>
			<p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
          </li>
          <li class="last">
            <h2>Our Goals</h2>
           
			<p>Sustain development and progress of the School.</p>
			<p>Continue to upgrade educational services and facilities responsive of the demands for change and needs of the society.</p>
			<p>Inculcate professional culture among management, faculty and personnel in the attainment of the institution's vision, mission and goals.</p>
			<p>Enhance research consciousness in discovering new dimensions for curriculum development and enrichment.</p>
			<p>Implement meaningful and relevant community outreach programs reflective of the available resources and expertise of the university.</p>
			<p>Establish strong networking of programs, sharing of resources and expertise with local and international educational institutions and organizations.</p>
			
          </li>
        </ul>
        <br class="clear" />
      </div>
    </div>
    <div class="fl_right">
      <h2>Why Study Here?</h2>
        <img class="imgl" src="../images/home/study.jpg" alt="" />
        <p>The raison d’etre  of the school is its great people: our graduates, students, faculty and management. Since the commencement of its journey in 1994, It has progressed by leaps and bounds both as an institution and the programs it delivers to the students. The focus here is to impart quality education and to train the students to become leaders of tomorrow in their chosen fields.  A university, it is said, makes a solemn pledge to uphold high standards and inculcate the same in its students, so that when they graduate we expect them to gain recognition and acclaim in the academia, society and industry.  It is with pride and gratitude that we acknowledge the recognition our alumni have earned in  the pursuit of their  professional lives. Working with partners and stakeholders from different sectors both at home and abroad, IT has gained prominence in both academic programs and management services. International accreditation of many of its programs now enables the university’s students to attain admissions at many leading international academic institutions for higher studies. The ISO Certification 9001-2008 with a scope on “Quality Management Operation System for the University” is another evidence of quality. The Job Placement of the graduates is enhanced due to school’s reputation. School has also made its mark in the field of sports and its students regularly bring home laurels from different tournaments. The medium of instruction is English. All class rooms are fully air conditioned and well equipped with multimedia facilities.  The School has a well stocked library, on campus cafeteria,  a gymnasium and many other facilities to make the tenure of our students a truly enjoyable experience. </p>
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