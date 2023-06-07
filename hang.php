<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
//	error_reporting(0);
	include_once('include/funcD.php');	
	if($_GET[action] and $_GET[action]=='logout'){
		session_destroy();
		echo "<script>location.href=index.php?e=User Logged Out Successfully</script>";
	}
?>
<META name="Author" content="">
<title>.:Welcome:::.</title>
<link rel="stylesheet" type="text/css" href="styletheme/menu.css" />
<link rel="stylesheet" type="text/css" href="ajaxfolder/ajaxtabs.css" />
<link rel="stylesheet" type="text/css" href="styletheme/ddlevelsmenu-base.css" />
<link rel="stylesheet" type="text/css" href="styletheme/ddlevelsmenu-topbar.css" />
<link rel="stylesheet" type="text/css" href="styletheme/ddlevelsmenu-sidebar.css" />
<link rel="stylesheet" type="text/css" href="styletheme/sitecontent.css" />

<script type="text/javascript" src="jsfolder/jsslides.js"></script>
<script type="text/javascript" src="jsfolder/ddlevelsmenu.js"></script>
<script type="text/javascript" src="ajaxfolder/ajaxtabs.js"></script>
<script type="text/javascript" src="ajaxfolder/new.js"></script>

  <tr><td width="100%" colspan="2"><img src="images/banner.png" width="100%" height="155" /></td></tr>
  <tr>
    <td height="26" valign="top" colspan="2">
		<div id="ddtopmenubar" class="mattblackmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#" rel="ddsubmenu1">Users</a></li>
                <li><a href="#" rel="ddsubmenu2">Update Module</a></li>
                <li><a href="#" rel="ddsubmenu3">Diet Management Module</a></li>
                <li><a href="#" rel="ddsubmenu4">Help Module</a></li>	
                <li><a href="#" rel="ddsubmenu5">About Module</a></li>	
                <?php if($_SESSION[uname] and $_SESSION[uname]!="") echo "<li><a href='index.php?action=logout'>Log Out</a></li>"; ?>
            </ul>
        </div>    
    
        <script type="text/javascript">
        ddlevelsmenu.setup("ddtopmenubar", "topbar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
        </script>	
        <ul id="ddsubmenu1" class="ddsubmenustyle">
          <li><a href="newPatient.php" title="Patient Bio Information">Registration</a></li>
          <li><a href="login.php" title="User Verification Page">Login</a></li>
        </ul>
        
        <ul id="ddsubmenu2" class="ddsubmenustyle">
          <li><a href="#.php" title="Patient Bio Information">Patient Information</a></li>
          <li><a href="#.php" title="Anthropometric and Laboratory Tests">Ant &amp; Lab Tests</a></li>
          <li><a href="#.php" title="Associated Diagnosed Ailments">Diagnosed Ailments</a></li>
          <li><a href="#.php" title="Diet Fixture">Diet Fixture</a></li>          
        </ul>
        
        <ul id="ddsubmenu3" class="ddsubmenustyle">
          <li><a href="dietician.php">Visit Dietician</a></li>
          <li><a href="CalorieConfig.php" title="Food-Calorie Configuration">Food-Calorie Configuration</a></li>          
          <li><a href="Personalization.php">Diet Personalization</a></li>
          <li><a href="#">Diet Prediction</a></li>
        </ul>
    
        <ul id="ddsubmenu4" class="ddsubmenustyle">
          <li><a href="#">System Help</a></li>
          <li><a href="#">Downloads</a></li>
        </ul>
        
        <ul id="ddsubmenu5" class="ddsubmenustyle">
          <li><a href="#">Researcher</a></li>
          <li><a href="#">Main Supervisor</a></li>
          <li><a href="#">Co-Supervisor</a></li>
          <li><a href="#">Department</a></li>
          <li><a href="#">Institution</a></li>
        </ul>
    </td>
</tr>