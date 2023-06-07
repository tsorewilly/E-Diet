<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="49%" align="center" border="">
<tr>
<?php include('hang.php'); ?>
    <td valign="top" width="70%">
       	<table width="60%" align="center" cellspacing="10" class="form">
        	<form method="post">
                <tr><td colspan="4"><img src="images/login.png" width="100%" height="40" /></td></tr>
                	<div class="db-query-report">
                    <?php
                        if($_POST){
							if(!Login($_POST[uname], $_POST[pass], $_POST[type]))
								echo "<div id='error'>Login Failed<br />Verify Your User Details and Try Again</div>";
							else{
								@$_SESSION[uname]=$_POST[uname];	@$_SESSION[type]=$_POST[type];
								echo "<script>location.href='index.php?e=suxes~~~Login Was Successful';</script>";
							}
                        }
						if($_GET){
                            $Msg = explode("~~~", $_GET[e]);
                            echo "<cite id='queryTime'>Query Processed in: $Msg[2] Second(s)</cite><div id='$Msg[1]'>$Msg[0]</div>";
						}

                    ?> 
                    </div>                   
                <tr>
                    <td width="30%"><label>Enter Username</label></td><td><input type="text" name="uname" id="" class="" maxlength="15" /> </td>
                </tr><tr>
                    <td><label>Password</label></td><td><input type="password" name="pass" id="" class=""  /> </td>
                </tr><tr>
                    <td><label>User Type</label></td><td>
                        <select name="type">
                            <option></option>
                            <option value="Patient">Patient</option>
                            <option value="Deitician">Dietician</option>
                            <option value="Adhoc">Ad Hoc User</option>
                        </select>
                    </td>
                </tr><tr>
                    <td align="center" colspan="4">
                        <input type="submit" class="" value="Validate Login" />
                        <input type="reset" class="" value="Clear Fields" />
                    </td>
                </tr>
			</form>
        </table>
    </td>
  </tr><tr>
    <td height="34" valign="top" colspan="2">
    	<div align="center">
            <span class="contenttext">
                Copyright ©Student Name (2014)<br />Department of Computer Science<br /> Federal University of Technology, Akure, Nigeria.
            </span>
		</div>
	</td>
  </tr>
</table>
</body>
</html>
<?php
	$emailMsg = "Thanks for Registering With Us";
?>