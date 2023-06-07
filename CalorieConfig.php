<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="69%" align="center" border="">
<tr>
<?php include('hang.php'); ?>
   	<form method="post">
    <td valign="top">
    	<?php getMsgs($_GET); ?>
       	<table width="60%" align="center" cellspacing="1" class="label" border="1">
        	<tr><td colspan="5"><img src="images/FoodClassConfig.png" width="100%" height="40" /></td></tr>
			<?php
				if($_POST){
					$Patient=array('HealthStatus','Carb','Prot','Fat', 'null');
					$QueryResponse = TJInsert($Patient, 'dietconfiguration', getPageName(), 'yes', 'no');
					getMsgs($QueryResponse);
				}
			?>
            <tr>
            	<td colspan="5">Enter Diet Configuration for New Health Status</td>
            </tr><tr>
            	<td rowspan="2">Health Status</td>
                <td colspan="3" align='center'>Diet Name<input type="text" name="HealthStatus" value="" style="width:340px" /></td>
            </tr><tr>
            	<td align="center">Carbohydrate <input type="text" name="Carb" value="" style="width:50px" /></td>
            	<td align="center">Protein <input type="text" name="Prot" value="" style="width:50px" /></td>
            	<td align="center" colspan="2">Fat <input type="text" name="Fat" value="" style="width:50px" /></td>
            </tr><tr>
                <td align="center" colspan="4">
                    <input type="submit" class="" value="Save Configuration" /><input type="reset" class="" value="Clear Information" />
                </td>
            </tr><tr>
            	<td colspan="5">Previously Configured Diet For Health Status</td>
            </tr><tr align="center" style="background:#9CC; font-size:12px">
            	<td width="25%">Health Status</td><td width="25%">Carbohydrate (%)</td><td width="25%">Protein (%)</td><td width="25%">Fat (%)</td>
            </tr>
            <?php
            	$Diets = AskDBWhereMultiple("SELECT * FROM dietconfiguration");
				for($i=0; $i<count($Diets); $i++){
					echo "<tr><td>".$Diets[$i][1]."</td><td>".$Diets[$i][2]."</td><td>".$Diets[$i][3]."</td><td>".$Diets[$i][4]."</td></tr>";
				}
			?>
        </table>
	</td></form>    	
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