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
        <li class="active"><a href="studentResult.php">Give Result</a></li>
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
      <li ><a href="teacherLogin.php">Teacher Home</a></li>
	  <li>&#187;</li>
      <li class="current"><a href="studentResult.php">Add Student Result</a></li>
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
	<br/>
	<center><h1>View all subject in this year</h1></center> 
	<center>
	<form  method="post">
	
	<table name="searchResut" border="1">
		<tr>
			<td width="40" height="15"><center>Subject ID</center></td>
			<td width="60" height="15"><center>Subject Name</center></td>
		<!--	<td width="45" height="15"><center>Teacher ID</center></td>  -->
			<td width="20" height="15"><center>Class</center></td>
			<td width="40" height="15"><center>Time</center></td>
			<td width="45" height="15"><center>Day</center></td>
			<td width="20" height="15"><center>Year</center></td>
		</tr>
	<?php 
		$count=0;
		$seryr="2016";
		$connect = oci_connect("HR", "rat", "localhost/XE");
		$query = "SELECT * FROM subject where (year = '".$seryr."' and te_id = '".$userId."')  order by subject_id asc";
		$result = oci_parse($connect, $query);
		oci_execute($result);
			
		while($row = oci_fetch_array($result, OCI_BOTH)) 
		{
			echo '<tr>';
			echo '<td width="40" height="15"><center>'.$row[0].'</center></td>';
			echo '<td width="60" height="15"><center>'.$row[1].'</center></td>';
			//echo '<td width="45" height="15"><center>'.$row[3].'</center></td>';
			echo '<td width="20" height="15"><center>'.$row[2].'</center></td>';
			echo '<td width="40" height="15"><center>'.$row[4].'</center></td>';
			echo '<td width="45" height="15"><center>'.$row[5].'</center></td>';
			echo '<td width="20" height="15"><center>'.$row[6].'</center></td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '<br/><br/>';
		
		oci_execute($result);
		echo '<h1>Select subject and student to assign Result</h1>';
		echo '</center>';
		echo '&nbsp &nbsp &nbsp Subject ID : <select name="selectSub">';
		while($row = oci_fetch_array($result, OCI_BOTH)) 
		{
			echo '<option value="'.$row[0].'">ID-'.$row[0].'</option>';
			$count++;
		}
		echo '</select>';
		
		
		echo '&nbsp <input type="submit" name="searchStu" value="Search Student "/>';	
		echo '</form>';
		
		

		if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["searchStu"]))
		{
			$subId=$_POST['selectSub'];
			$cou=0;
			
			
			
			
			$query1 = "SELECT * FROM student_sub where (year = '".$seryr."' and sub_id = '".$subId."')";
			$result = oci_parse($connect, $query1);
			oci_execute($result);
			
			echo '<br/><br/>';
			echo '<form  method="post" action="result.php">';
			
			echo '&nbsp &nbsp &nbsp student ID : <select name="stuId" >';
			echo '<option value="0">select student</option>';
			while($row1 = oci_fetch_array($result, OCI_BOTH)) 
			{
				echo '<option value="'.$row1[1].'">'.$row1[1].'</option>';
				$cou++;
				//echo $row[1];
			}
			echo '</select>';
			
			echo "<input type='hidden' name='subId' value='" .$subId. "' />";
			//echo "<input type='hidden' name='stuId' value='" .$stuId. "' />";
			
			echo '&nbsp <input type="submit" name="selectStu" value="select Student" />';
			if($cou==0)
			{
				echo '<script language="javascript">'; 
				echo 'alert("Sorry No student added the class!!!")';
				echo '</script>';
			}	
			//echo '</form>';
			
		}
		if($count==0)
		{
			echo '<script language="javascript">'; 
			echo 'alert("Sorry you have not assign any subject yet!!!")';
			echo '</script>';
		}
	?>
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