<!DOCTYPE html >

<?php
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
	}
	
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submitUpdate"]))
	{
		
			
			if (empty($_POST["stuId"])) {
				echo '<script language="javascript">';
				echo 'alert("Student ID is required")';
				echo '</script>';
			} else {
				$stuId=$_POST["stuId"];
			}
			
			if (empty($_POST["subId"])) {
				echo '<script language="javascript">';
				echo 'alert("Subject ID is required")';
				echo '</script>';
			} else {
				$subId=$_POST["subId"];
			}
			
			if (empty($_POST["year"])) {
				echo '<script language="javascript">';
				echo 'alert("Subject ID is required")';
				echo '</script>';
			} else {
				$year=$_POST["year"];
			}
			
			if(!empty($_POST["subId"]) && !empty($_POST["stuId"]) && !empty($_POST["year"]))
			{
				
				$connect = oci_connect("HR", "rat", "localhost/XE");
				
				$query = "insert into student_sub values ('".$subId."','".$stuId."',null,null,null,null,'".$year."')";
				
				$sstuId = oci_parse($connect, $query);
				oci_execute($sstuId);
				
				echo '<script language="javascript">';
				echo 'alert("Student Assign!!!")';
				echo '</script>';
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
        <li > <a href="adminLogin.php">Home</a></li>
        <li ><a href="addStudent.php">Add Student</a></li>
        <li ><a href="addTeacherInfo.php">Add Teacher</a></li>
        <li class="active"><a href="assStudentSub.php">Registation</a></li>
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
      <li class="current"><a href="assStudentSub.php">Assigning student</a></li>
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
    
	<center>
	<form  method="post">
	<br/><br/>
	Student Id: <input type="text" name="stuId" placeholder="Id Number"></input>
	<select name="year">
		<option value="2016">2016</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		
	</select>
	<input type="submit" name="search" value=" Search "/>
		<br/><br/>
		
<?php 
	
	
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["search"]))
	{
		if(empty($_POST["stuId"]))
		{
			echo '<script language="javascript">';
			echo 'alert("Give The Student Id First!!!")';
			echo '</script>';
			
			
		}
		else
		{
			$stuId=$_POST["stuId"];
			$year=$_POST["year"];
			$count=0;
			//echo $stuId;
			$connect = oci_connect("HR", "rat", "localhost/XE");
			$query = "select * from subject where ( cls=(SELECT cls FROM student_info where student_id = '".$stuId."') and year = '".$year."') ORDER BY subject_id ASC";
			//$query = "select * from subject where ( cls=10 and year = '2016')";
			$result = oci_parse($connect, $query);
			
			oci_execute($result);
			
			while($row = oci_fetch_array($result, OCI_BOTH)) 
			{
				//echo $row[2];
				if($count==0)
				{
					echo '<br/><br/>';
					echo '<center><h1>Created subject from class </h1></center>  ';
					echo '<table name="searchResut" border="1">';
					echo '<tr>';
					echo '<td width="40" height="15"><center>Subject ID</center></td>';
					echo '<td width="60" height="15"><center>Subject Name</center></td>';
					//echo '<td width="45" height="15"><center>Teacher ID</center></td>';
					echo '<td width="20" height="15"><center>Class</center></td>';
					echo '<td width="40" height="15"><center>Time</center></td>';
					echo '<td width="45" height="15"><center>Day</center></td>';
					echo '<td width="20" height="15"><center>Year</center></td>';
					echo '</tr>';
					$count++;
				}
				//elseif($count>0)
				//{
					//echo 'test-2';
					echo '<tr>';
					echo '<td width="40" height="15"><center>'.$row[0].'</center></td>';
					echo '<td width="60" height="15"><center>'.$row[1].'</center></td>';
					//echo '<td width="45" height="15"><center>'.$row[3].'</center></td>';
					echo '<td width="20" height="15"><center>'.$row[2].'</center></td>';
					echo '<td width="40" height="15"><center>'.$row[4].'</center></td>';
					echo '<td width="45" height="15"><center>'.$row[5].'</center></td>';
					echo '<td width="20" height="15"><center>'.$row[6].'</center></td>';
					echo '</tr>';
					
				//}
				
				
			}
				echo '</table>';
					echo '<br/><br/>';
					echo '<center><h1>Assign Student to flowing subject </h1></center>  ';
					echo '<br>';
					echo '<table  border="1" >';
					echo '<tr>';
					echo '	<td width="100" height="25">Student ID</td>';
					echo '	<td>';
					echo '		<center><input type="text" name="stuId" value='.$stuId.' style="width:250px;"/></center>';
					echo '	</td>';
					echo '</tr>';
					echo '<tr>';
					echo '	<td width="100" height="25">Subject ID</td>';
					echo '	<td>';
					echo '		<center><input type="text" name="subId" value="" style="width:250px;"/></center>';
					echo '	</td>';
					echo '</tr>';
					echo '<tr>';
					echo '	<td width="100" height="25">Year</td>';
					echo '	<td>';
					echo '		<center><input type="text" name="year" value='.$year.' style="width:250px;"/></center>';
					echo '	</td>';
					echo '</tr>';
					
					echo '</table>';
					echo '<center><input type="submit" name="submitUpdate" value=" Assign "/></center>';
			
		}
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