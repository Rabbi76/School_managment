<!DOCTYPE html >

<?php
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
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
        <<li > <a href="adminLogin.php">Home</a></li>
        <li ><a href="addStudent.php">Add Student</a></li>
        <li ><a href="addTeacherInfo.php">Add Teacher</a></li>
        <li ><a href="assStudentSub.php">Registation</a></li>
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
      <li ><a href="adminLogin.php">Admin Home</a></li>
      <li>&#187;</li>
      <li class="current"><a href="searchStudent.php">Search Student</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    
    <div id="column">
      
        <div class="subnav">
        <h2>ADMIN HOME</h2>
         <ul>
		  <li><a><B>Post Notice</B></a>
		    <ul>
              <li><a href="postNotice.php">Post new notice</a></li>
              <li><a href="allNotice.php">Edit/delete notice</a></li>
            </ul>
		  </li>
          <li><a><B>Student</B></a>
			<ul>
			  <li><a href="searchStudent.php">Search Student</a></li>
              <li><a href="addStudent.php">Add new student</a></li>
              <li><a href="editstudent.php">Edit student info</a></li>
			  <li><a href="studentClass.php">Class, Subject & Result</a></li>
			<!--  <li><a href="addFee.php">Add fee</a></li>  -->
            </ul>
		  </li>
          <li><a><B>Teacher</B></a>
            <ul>
              <li><a href="addTeacherInfo.php">Add new teacher</a></li>
			  <li><a href="viewTeacher.php">View Teacher</a></li>
			  <li><a href="editTeacher.php">Edit teacher</a></li>
			  <li><a href="teacherAssigned.php">Assigned Class & Subject</a></li>
            </ul>
          </li>
         <li><a><B>Parent</B></a>
            <ul>
			  <li><a href="viewParentInfo.php">View parent info</a></li>
              <li><a href="addParent.php">Add new parent</a></li>
              <li><a href="editParent.php">Edit parent info</a></li>
            </ul>
          </li>
		  <li><a><B>Class & Subject</B></a>
            <ul>
              <li><a href="classSub.php">Set class & Subject & Time</a></li>
              <li><a href="editClassSub.php">view class & Subject </a></li>
			  <li><a href="assTeacherSub.php">Assign Teacher to C & S</a></li>
			  <li><a href="assStudentSub.php">Assign student to C & S</a></li>
			  <li><a href="assignedStuList.php">Assigned student List</a></li>
            </ul>
          </li>
        </ul>
      </div>
      
    </div>
	
	<div id="content">
    <center><h1>Search Students</h1></center>  
	<center>
	<form  method="post">
	Search By: <select name="searchtype">
		<option value="-1">--[Choose Option]--</option>
		<option value="1">Name</option>
		<option value="2">ID</option>
	</select>
	<input type="text" name="searchVal"></input>
	<input type="submit" name="submitSearch" value="Search"/>	
	</center>
	<br/><br/>
	
	<table name="searchResut" border="1">
		<tr>
			<td width="45" height="15"><center>ID</center></td>
			<td width="60" height="15"><center>Name</center></td>
			<td width="20" height="15"><center>Class</center></td>
			<td width="15" height="15"><center>Result</center></td>
			<td width="60" height="15"><center>Father</center></td>
			<td width="15" height="15"><center>phone</center></td>
		</tr>
	
	<?php
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submitSearch"]))
	{
		//echo 'hi';
		$serTy=$_POST['searchtype'];
		$serVal=$_POST['searchVal'];
		
		//echo $serTy;
		//echo $serVal;
		
		if($serTy==1)
		{
		//	echo '1';
		//echo $serVal;
		
			$connect = oci_connect("HR", "rat", "localhost/XE");
			$query = "SELECT * FROM student_info where full_name like '%$serVal%'";
			$result = oci_parse($connect, $query);
			
		//	oci_bind_by_name($result, ":serVal", $serVal);
		//	echo $query ;
			oci_execute($result);
			
			while($row = oci_fetch_array($result, OCI_BOTH)) 
			{
				//echo '0.1';
				
				echo '<tr>';
				echo '<td width="45" height="15"><center>'.$row[0].'</center></td>';
				echo '<td width="50" height="15"><center>'.$row[1].'</center></td>';
				echo '<td width="20" height="15"><center>'.$row[5].'</center></td>';
				echo '<td width="15" height="15"><center>'.$row[8].'</center></td>';
				echo '<td width="60" height="15"><center>'.$row[2].'</center></td>';
				echo '<td width="15" height="15"><center>'.$row[6].'</center></td>';
				echo '</tr>';
			
			}
			

		}
		elseif($serTy==2)
		{
			//echo '2';
			//echo $serVal;
			$connect = oci_connect("HR", "rat", "localhost/XE");
			$query2 = "SELECT * FROM student_info where student_id like '%$serVal%'";
			$result2 = oci_parse($connect, $query2);
			
			//oci_bind_by_name($result2, ':serVal', $serVal);
			//echo $query2 ;
			//echo $result2 ;
			oci_execute($result2);
			
			while($row = oci_fetch_array($result2, OCI_BOTH)) 
			{
		//	echo '0.2';
				echo '<tr>';
				echo '<td width="45" height="15"><center>'.$row[0].'</center></td>';
				echo '<td width="50" height="15"><center>'.$row[1].'</center></td>';
				echo '<td width="20" height="15"><center>'.$row[5].'</center></td>';
				echo '<td width="15" height="15"><center>'.$row[8].'</center></td>';
				echo '<td width="50" height="15"><center>'.$row[2].'</center></td>';
				echo '<td width="15" height="15"><center>'.$row[6].'</center></td>';
				echo '</tr>';
			
			}
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Choose the Search By Option")';
			echo '</script>';
		}
	}
		
	?>
	
		<tr>
			<td width="45" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="20" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
		</tr>
		<tr>
			<td width="45" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="20" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
		</tr>
		<tr>
			<td width="45" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="20" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
		</tr>
		<tr>
			<td width="45" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="20" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
			<td width="60" height="15"><center></center></td>
			<td width="15" height="15"><center></center></td>
		</tr>
		
	</table>
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