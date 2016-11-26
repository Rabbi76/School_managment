<!DOCTYPE html >

<?php
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
	}
	if(($_SERVER ["REQUEST_METHOD"]=="POST") && isset($_POST["submit"]))
	{
			$cls=$_POST["selectClass"];
			$sname=$_POST["selectSubject"];
			
			if ($cls=="-1")
			{
			echo '<script language="javascript">';
			echo 'alert("Select the class")';
			echo '</script>';
			} 
		  
			if ($sname=="-1")
			{
				echo '<script language="javascript">';
				echo 'alert("Select the Subject name")';
				echo '</script>';
			} 
			if (empty($_POST["classTime"]))
			{
				echo '<script language="javascript">';
				echo 'alert("Class time is required")';
				echo '</script>';
			} else {
				$time=$_POST["classTime"];
			}
			  
			if (empty($_POST["classday"])) {
				echo '<script language="javascript">';
				echo 'alert("Day is required")';
				echo '</script>';
			} else {
				$day=$_POST["classday"];
			}
			
			if (empty($_POST["year"])) {
				echo '<script language="javascript">';
				echo 'alert("Year is required")';
				echo '</script>';
			} else {
				$year=$_POST["year"];
			}
			
			if($cls!="-1" && $sname!="-1" && !empty($_POST["classTime"]) && !empty($_POST["classday"]) && !empty($_POST["year"]))
			{
			$connect = oci_connect("HR", "rat", "localhost/XE");
			
			$query = "insert into subject values (null,'${sname}','${cls}',null,'${time}','${day}','${year}')";
			
			$stid = oci_parse($connect, $query);
			oci_execute($stid);
			
			echo '<script language="javascript">';
			echo 'alert("class is added")';
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
      <li class="current"><a href="classSub.php">Set class & Subject & Time</a></li>
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
    <center><h1>Add subject for class</h1></center> 
	<br><br>	
	<form method ="post">
	<table border="1">
		<tr>
			<td width="150" height="20">Select Class</td>
			<td width="150" height="20">
				<center><select name="selectClass" id="selectClass" style="width:250px;">
						<option value="-1"><center>--------------[ Select Class]-------------</option>
						<option value="1">STD-1</option>
						<option value="2">STD-2</option>
						<option value="3">STD-3</option>
						<option value="4">STD-4</option>
						<option value="5">STD-5</option>
						<option value="6">STD-6</option>
						<option value="7">STD-7</option>
						<option value="8">STD-8</option>
						<option value="9">STD-9</option>
						<option value="10">STD-10</option>
				</select></center>
			</td>
		</tr>
		<tr>
			<td width="150" height="20">Subject Name</td>
			<td width="150" height="20">
				<center><select name="selectSubject" id="selectSubject" style="width:250px;">
						<option value="-1"><center>--------------[ Select Subject]-------------</option>
						<option value="Bangla">Bangla</option>
						<option value="English">English</option>
						<option value="Maths">Maths</option>
						<option value="Islam Religion">Islam Religion</option>
						<option value="Hindu Religion">Hindu Religion</option>
						<option value="ICT">ICT</option>
						<option value="Bangladesh & Global Studies">Bangladesh & Global Studies</option>
						<option value="Physical Studies & Health">Physical Studies & Health</option>
						<option value="Science">Science</option>
						<option value="Krishi Shikkha">Krishi Shikkha</option>
						<option value="Home Science">Home Science</option>
		<!--				<option value="Bangla-1">Bangla-1</option>
						<option value="Bangla-2">Bangla-2</option>
						<option value="English-1">English-1</option>
						<option value="English-2">English-2</option>
						<option value="Physics">Physics</option>
						<option value="Chemistry">Chemistry</option>
						<option value="H.Maths">H.Maths</option>
						<option value="Biology">Biology</option>
						<option value="Chemistry">Chemistry</option>
						<option value="H.Maths">H.Maths</option>
						<option value="Biology">Biology</option>
						<option value="ICT">ICT</option>
						<option value="Hindu Religion">Hindu Religion</option>
						<option value="Bangladesh & Global Studies">Bangladesh & Global Studies</option>
						<option value="Physical Studies & Health">Physical Studies & Health</option>
						<option value="10">Chemistry</option>  -->
				</select></center>
			</td>
		</tr>
		<tr>
			<td width="150" height="20">Class Time (start-end)</td>
			<td>
				<center><input type="text" name="classTime" style="width:250px;"  placeholder="ex: 11.00am-12.30pm"/></center>
			</td>
		</tr>
		<tr>
			<td width="150" height="20">Class day(1 or more)</td>
			<td>
				<center><input type="text" name="classday" style="width:250px;"  placeholder="ex: sun,mon,thus,wed"/></center>
			</td>
		</tr>
		<tr>
			<td width="150" height="20">Year</td>
			<td>
				<center><input type="text" name="year" style="width:250px;"/></center>
			</td>
		</tr>
	</table>
	
	<center><input  name="submit" type="submit" value="Add Subject"/></center>
	
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