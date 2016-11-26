<!DOCTYPE html >

<?php
	
	session_start();
	if(!isset($_SESSION["login_user"]))
	{
		header("Location:../../index.php");
	}
	
	if(($_SERVER["REQUEST_METHOD"]=="POST") && isset($_POST["submit"]))
	{
		//echo "sdasdasd";
		if (empty($_POST["notice"]))
		{
			echo '<script language="javascript">';
			echo 'alert("Name is required")';
			echo '</script>';
		} else {
			$ti=$_POST["notice"];
		}
		  
		if (empty($_POST["noticeBody"])) {
			echo '<script language="javascript">';
			echo 'alert("Comment is required")';
			echo '</script>';
		} else {
			$de=$_POST["noticeBody"];
		}
		
		$nf=$_POST["notice_for"];
		$nt=$_POST["notice_type"];
		
		if(!empty($_POST["notice"]) && !empty($_POST["noticeBody"]))
		{
			$connect = oci_connect("HR", "rat", "localhost/XE");
		
			$query = "insert into notice values (null,'${ti}','${de}','${nt}','${nf}',sysdate)";
			$stid = oci_parse($connect, $query);
			oci_execute($stid);
			
			echo '<script language="javascript">';
			echo 'alert("Notice Posted")';
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
      <li class="current"><a href="postNotice.php">Post Notice</a></li>
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
	 <form method="post" >
		<br/><br/>
		<h2>Post Notice</h2>
		Notice Title <input type="text" name="notice" style="width:250px; height:20px;" />
		<br/><br/>
		Notice For: <select name="notice_for" id="notice_for">
						<option value="General">General</option>
						<option value="Teacher">Teacher</option>
						<option value="Parent">Parent</option>
						<option value="Student">Student</option>
						</select>
						<br/><br/>
						Notice Type: <select name="notice_type" id="notice_for">
						<option value="Picnic">Picnic</option>
						<option value="Impornant Date">Impornant Date</option>
						<option value="School Off">School Off</option>
						<option value="New Rule">New Rule</option>
						<option value="volunteer">volunteer</option>
						<option value="Sports">Sports</option>
						<option value="File">File</option>
						<option value="Else">Else</option>
						</select>
						<br/><br/>
		 <textarea name="noticeBody" id="comment" cols="100%" rows="10"></textarea>
		 <br/><br/>
						<input name="submit" type="submit" id="submit" value="Submit Form" />
	  
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