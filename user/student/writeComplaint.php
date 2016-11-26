<!DOCTYPE html >
<html>
<?php
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
	}
	else 
	{
		$userId =$_SESSION["login_user"];
		//echo $userId;
	
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submit"]))
	{
		if (empty($_POST["comment"])) 
		{
			echo '<script language="javascript">';
			echo 'alert("Comment is required")';
			echo '</script>';
		} 
		else 
		{
			$de=$_POST["comment"];
			$connect = oci_connect("HR", "rat", "localhost/XE");
			
			$query = "select full_name,email from student_info where student_id='".$userId."'";
			$result = oci_parse($connect, $query);
			oci_execute($result);
			
			while($row = oci_fetch_array($result, OCI_BOTH)) 
			{
				$ti=$row[0]." [Student]";  
				$ty=$row[1];  
						
			
				$query = "insert into commentes values (null,'${ti}','${ty}',sysdate,'${de}')";
				$stid = oci_parse($connect, $query);
				oci_execute($stid);
				
				echo '<script language="javascript">';
				echo 'alert("Comment Posted")';
				echo '</script>';
			}
		}
	}
	}
?>

<head>
<title>School Manangment System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../../layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="../../layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="../../layout/scripts/jquery.slidepanel.setup.js"></script>
</head>
<body>
<div class="wrapper col0">
  <div id="topbar">
    
    <div id="loginpanel">
      <ul>
       
        <li class="right" ><a href="../../index.php">Logout</a><a id="closeit" style="display:none;" href="#slidepanel">Close Panel</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1>King's School & College</a></h1>
      <p>Education is life</p>
    </div>
    <div id="topnav">
      <ul>
        <li > <a href="studentLogin.php">Home</a></li>
        <li ><a href="viewResult.php">Student result</a></li>
        <li ><a href="teacherInfo.php">Teacher Info</a></li>
        <li class="active"><a href="writeComplaint.php">Comment</a></li>
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
      <li class="current"><a href="writeComplaint.php">Comment</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    
    <div id="column">
      <div class="subnav">
        <h2> Home</h2>
        <ul>
		  <li><a><B>Class</B></a>
		    <ul>
              <li><a href="studentLogin.php">View All class</a></li>
            </ul>
		  </li>
          <li><a><B>Result</B></a>
			<ul>
              <li><a href="viewResult.php">View Result</a></li>
            </ul>
		  </li>
          <li><a><B>Teacher</B></a>
            <ul>
              <li><a href="teacherInfo.php">View teacher info</a></li>
            </ul>
          </li>
		  <li><a><B>Complaints</B></a>
            <ul>
              <li><a href="writeComplaint.php">Write a complaint</a></li>
            </ul>
          </li>
        </ul>
      </div>
      
    </div>
	
	<div id="content">
    <center><h1>Comment</h1></center>  
	 <div id="respond">
        <form action="#" method="post">
         <br>
          <p>
            <textarea name="comment" id="comment" cols="100%" rows="10"></textarea>
            <label name="comment" style="display:none;"><small>Comment (required)</small></label>
          </p>
          <p>
            <input name="submit" type="submit" id="submit" value="Submit Form" />
          </p>
        </form>
      </div>
			  
   </div>
    <div class="clear"></div>
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