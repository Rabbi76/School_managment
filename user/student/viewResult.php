<!DOCTYPE html >
<html>
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
        <li > <a href="studentLogin.php">Home</a></li>
        <li class="active"><a href="viewResult.php">Student result</a></li>
        <li ><a href="teacherInfo.php">Teacher Info</a></li>
        <li><a href="writeComplaint.php">Comment</a></li>
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
      <li class="current"><a href="viewResult.php">View Result</a></li>
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
    <center><h1>Student Result</h1></center>  
	<center>
	<form  method="post">
	<?php
		
		
			$year='2016';
			
			$count=0;
			$connect = oci_connect("HR", "rat", "localhost/XE");
			$query = "SELECT * FROM student_sub where (St_id = '".$userId."' and year = '".$year."') ORDER BY sub_id ASC";
		
			$result = oci_parse($connect, $query);
			oci_execute($result);
				
				
			while($row = oci_fetch_array($result, OCI_BOTH)) 
			{
				if($count==0)
				{
					echo '<table name="searchResut" border="1">';
					echo '<tr>';
					echo '<td width="45" height="15"><center>Subject ID</center></td>';
					echo '<td width="60" height="15"><center>subject Name</center></td>';
					echo '<td width="60" height="15"><center>Teacher Name</center></td>';
					echo '<td width="20" height="15"><center>Midterm</center></td>';
					echo '<td width="20" height="15"><center>Finalterm</center></td>';
					echo '<td width="20" height="15"><center>Total Mark</center></td>';
					echo '<td width="20" height="15"><center>Gread</center></td>';
					echo '</tr>';
					$count++;
				}
					$connect = oci_connect("HR", "rat", "localhost/XE");
					$query2 = "SELECT * FROM subject where subject_id like '%$row[0]%'";
					
					$result2 = oci_parse($connect, $query2);
		
					oci_execute($result2);
					
					if($row2 = oci_fetch_array($result2, OCI_BOTH)) 
					{
						$query3 = "SELECT full_name FROM teacher_info where teacher_id like '%$row2[3]%'";
					
						$result3 = oci_parse($connect, $query3);
		
						oci_execute($result3);
						if($row3 = oci_fetch_array($result3, OCI_BOTH)) 
						{
							echo '<tr>';
							echo '<td width="45" height="15"><center>'.$row2[0].'</center></td>';
							echo '<td width="60" height="15"><center>'.$row2[1].'</center></td>';
							
							echo '<td width="60" height="15"><center>';
								if(!isset($row3[0]))
								{
									echo 'Not assign';
								}
								else
								{
									echo $row3[0];
								}	
							echo '</center></td>';
							
							echo '<td width="20" height="15"><center>';
								if(!isset($row[4]))
								{
									echo '---';
								}
								else
								{
									echo $row[4];
								}	
							echo '</center></td>';
							echo '<td width="20" height="15"><center>';
								if(!isset($row[5]))
								{
									echo '---';
								}
								else
								{
									echo $row[5];
								}	
							echo '</center></td>';
							echo '<td width="20" height="15"><center>';
								if(!isset($row[2]))
								{
									echo '---';
								}
								else
								{
									echo $row[2];
								}	
							echo '</center></td>';
							echo '<td width="20" height="15"><center>';
								if(!isset($row[3]))
								{
									echo '---';
								}
								else
								{
									echo $row[3];
								}	
							echo '</center></td>';
							echo '</tr>';
						}
					}
				}
				if($count==0)
				{
					echo '<br/><br/>';
					echo ' No Subject Addded Yet!!!!';
					echo "<script>
					alert('No Subject added yet!!!');
					</script>";
					
				}
				echo '</table>';
	?>
	
	
	</center>
			  
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