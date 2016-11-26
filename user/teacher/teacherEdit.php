<!DOCTYPE html >

<?php
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
	}
	$userId =$_SESSION["login_user"];
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submitUpdate"]))
	{
			
			$name=$_POST["idname"];
			$address=$_POST["address"];
			$phone=$_POST["phone"];
			$email=$_POST["ename"];
			
			$connect = oci_connect("HR", "rat", "localhost/XE");
			
			$query = "UPDATE teacher_info SET full_name = '".$name."', address = '".$address."', phone =".$phone." ,email = '".$email."' WHERE teacher_id='".$userId."'";
			
			$stid = oci_parse($connect, $query);
			oci_execute($stid);
			
			echo '<script language="javascript">';
			echo 'alert("Your information is updated")';
			echo '</script>';
		
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
        <li > <a href="teacherLogin.php">Home</a></li>
        <li ><a href="searchStudent.php">Search Studentt</a></li>
        <li ><a href="studentResult.php">Give Result</a></li>
        <li class="active"><a href="teacherEdit.php">Account setting</a></li>
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
      <li ><a href="teacherLogin.php">Teacher Home</a></li>
	  <li>&#187;</li>
      <li class="current"><a href="teacherEdit.php">Edit Info</a></li>
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
    <center><h1>Edit Teacher Information</h1></center>  
	
	<form method="post">
	<table border="1">
	 <?php
		$count=0;
		
		$connect = oci_connect("HR", "rat", "localhost/XE");
		//echo $userId;
		$query = "SELECT * FROM teacher_info where teacher_id = '".$userId."'";
		$result = oci_parse($connect, $query);
		echo '<br>';
		oci_execute($result);
		while($row = oci_fetch_array($result, OCI_BOTH)) 
		{
			echo '<tr>';
				echo '<td width="100" height="10">ID</td>';
				echo '<td width="250px" height="10">'.$row[0].'</td>';
				//echo '<td>';
				//	echo '<input type="text" name="idtxt" value="'.$row[0].'" style="width:250px;"/>';
				//echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td width="100" height="10">Name</td>';
				echo '<td>';
					echo '<center><input type="text" name="idname" value="'.$row[1].'" style="width:250px;"/></center>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td width="100" height="10">Email:</td>';
				echo '<td>';
					echo '<center><input type="text" name="ename" value="'.$row[4].'" style="width:250px;"/></center>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td width="100" height="10">Phone:</td>';
				echo '<td>';
					echo '<center><input type="text" name="phone" value="'.$row[3].'" style="width:250px;"/></center>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td width="100" height="10">Address:</td>';
				echo '<td>';
					echo '<center><input type="text" name="address" value="'.$row[2].'" style="width:250px;"/></center>';
				echo '</td>';
			echo '</tr>';
		}
	?>	
		
	</table>
	<center><input type="submit" name="submitUpdate" value="Update"/></center>
	
   </form>
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