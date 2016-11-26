<!DOCTYPE html >

<?php
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
	}
	$userId =$_SESSION["login_user"];
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
        <li > <a href="teacherLogin.php">Home</a></li>
        <li ><a href="searchStudent.php">Search Studentt</a></li>
        <li ><a href="studentResult.php">Give Result</a></li>
        <li><a href="teacherEdit.php">Account setting</a></li>
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
      <li class="current"><a href="teacherLogin.php">Teacher Home</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    
    <div id="column">
      <div class="subnav">
         <h2>Teacher Home</h2>
        <ul>
		  <li><a><B>View Notice</B></a>
		    <ul>
              <li><a href="viewNotice.php">View All Notice</a></li>
            </ul>
		  </li>
          <li><a><B>Student</B></a>
			<ul>
              <li><a href="searchStudent.php">Search Student</a></li>
            </ul>
		  </li>
          <li><a><B>Teacher</B></a>
            <ul>
              <li><a href="teacherEdit.php">Edit teacher info</a></li>
			  <li><a href="teacherAssigned.php">View Assigned Class & Subject</a></li>
            </ul>
          </li>
         <li><a><B>Parent</B></a>
            <ul>
              <li><a href="viewParentInfo.php">View parent info</a></li>
            </ul>
          </li>
		  <li><a><B>Results</B></a>
            <ul>
              <li><a href="studentResult.php">Add or Edit Student Result</a></li>
              <li><a href="viewAllStudentRsult.php">View Student class & result</a></li>
            </ul>
          </li>
        </ul>
      </div>
      
    </div>
	
	<div id="content">
    <div id="comments">
	  
        <center><h2>Notice</h2></center>
        <ul class="commentlist">
         <?php
		$count=0;
		
		$connect = oci_connect("HR", "rat", "localhost/XE");
		$query = "SELECT * FROM notice order by notice_id desc ";
		$result = oci_parse($connect, $query);
     
		oci_execute($result);
	while($row = oci_fetch_array($result, OCI_BOTH)) 
	{
		if($count<6 && $row[4]=="Teacher")
		{
			if($count%2==0)echo '<li class="comment_odd">';
			else echo '<li class="comment_even">'; 
			
			echo '<p><ins><strong><a href="pages/notice.php">'.$row[1].'</a></strong></ins></p>';
			echo '<div class="submitdate"><a href="#">'.$row[5].'</a></div>';
			echo '<p>'.$row[2].'<p>';
			//echo '<br>';
			echo '</li>';
			$count++;
		}
	}
?>	
		  
        </ul>
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