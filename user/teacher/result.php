<!DOCTYPE html >

<?php
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
	}
	
	$co=0;
	if($co==0)
	{
	$userId =$_SESSION["login_user"];
	$subId=$_POST['subId'];
	$stuId=$_POST['stuId'];
	$co++;
	}
	
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submitUpdate"]))
	{
			$subId=$_POST["subId"];
			$stuId=$_POST["stuId"];
			
			if ($_POST["midM"]=="---")
			{
				$midM= NULL;
			} else {
				$midM=$_POST["midM"];
			}
			if ($_POST["finalM"]=="---")
			{
				$finalM= NULL;
			} else {
				$finalM=$_POST["finalM"];
			}
			if ($_POST["totalM"]=="---")
			{
				$totalM= NULL;
			} else {
				$totalM=$_POST["totalM"];
			}
			if ($_POST["totalG"]=="---")
			{
				$totalG= NULL;
			} else {
				$totalG=$_POST["totalG"];
			}
			

			
			$connect = oci_connect("HR", "rat", "localhost/XE");
			
			$query = "UPDATE student_sub SET mid_mark = '".$midM."', final_mark = '".$finalM."', total_mark ='".$totalM."' ,gread = '".$totalG."' WHERE (St_id='".$stuId."' and sub_id='".$subId."')";
			
			$stid = oci_parse($connect, $query);
			oci_execute($stid);
			
			//echo '<script language="javascript">';
			//echo 'alert("Student result is set")';
			//echo '</script>';
			//header("Location:studentResult.php");
			
			echo "<script>
				alert('Result assigned');
				window.location.href='studentResult.php';
				</script>";
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
	<center>
	<form  method="post">
	
	<?php 

				
				
				//echo $subId;
				//echo $stuId;
				$cou=0;
				//echo $stuId;
				//echo 'test';
				echo '<br/><br/>';
				
				echo '<center>';
				echo '<h1>Assign Result</h1>';
				echo '<table border="1">';
				
				$connect = oci_connect("HR", "rat", "localhost/XE");
				
				$query = "SELECT * FROM student_sub where (St_id = '".$stuId."' and sub_id = '".$subId."')";
				$result = oci_parse($connect, $query);
				
				oci_execute($result);
				
				while($row = oci_fetch_array($result, OCI_BOTH)) 
				{
					//echo 'test';
					echo '<tr>';
						echo '<td width="200" height="20">Subject Id</td>';
						echo '<td width="250px" height="10">'.$subId.'</td>';
						echo "<input type='hidden' name='subId' value='" .$subId. "' />";
					echo '</tr>';
					
					echo '<tr>';
						echo '<td width="200" height="20">Student Id</td>';
						echo '<td width="250px" height="10">'.$stuId.'</td>';
						echo "<input type='hidden' name='stuId' value='" .$stuId. "' />";
					echo '</tr>';
					
					echo '<tr>';
						echo '<td width="200" height="20">Mid mark</td>';
						echo '<td>';
							if(!isset($row[4]))
							{
								echo '<center><input type="text" name="midM" value="---" style="width:250px;"/></center>';
							}
							else
							{
								echo '<center><input type="text" name="midM" value="'.$row[4].'" style="width:250px;"/></center>';
							}	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td width="200" height="20">Final mark</td>';
						echo '<td>';
							if(!isset($row[5]))
							{
								echo '<center><input type="text" name="finalM" value="---" style="width:250px;"/></center>';
							}
							else
							{
								echo '<center><input type="text" name="finalM" value="'.$row[5].'" style="width:250px;"/></center>';
							}	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td width="200" height="20">Total Mark</td>';
						echo '<td>';
							if(!isset($row[2]))
							{
								echo '<center><input type="text" name="totalM" value="---" style="width:250px;"/></center>';
							}
							else
							{
								echo '<center><input type="text" name="totalM" value="'.$row[2].'" style="width:250px;"/></center>';
							}	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td width="200" height="20">Total Gread</td>';
						echo '<td>';
							if(!isset($row[3]))
							{
								echo '<center><input type="text" name="totalG" value="---" style="width:250px;"/></center>';
							}
							else
							{
								echo '<center><input type="text" name="totalG" value="'.$row[3].'" style="width:250px;"/></center>';
							}	
						echo '</td>';
					echo '</tr>';
				}
				
				echo '</table>';
				echo '<center><input type="submit" name="submitUpdate" value="Submit"/></center>';
				echo '</center>';		
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