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
		<?php
            if($_SESSION[uname]){
                $p_info=AskDBWhereSingle("SELECT * FROM patientbio WHERE email=(SELECT email from users WHERE uname='".(@$_SESSION[uname])."')");
                $details=AskDBWhereSingle("SELECT d.did, dd.ht, dd.wt, dd.bmi, dd.al, dd.bs_value, d.result, d.formular, d.period
                                                FROM dietary_data dd, diagnosis d WHERE dd.id = d.did AND d.did ='".$_GET[did]."'");
                $Diagnosis = classify($details[6]);
		?>
       	<table width="100%" align="center" cellspacing="1" class="label" border="1">
        	<tr><td width="50%">
            	<table width="100%" border="1"><?php
					echo "<tr><td colspan='2'>Result From Diagnosis</td><td colspan='2'>".$Diagnosis."</td></tr>";
//Calculating The Broca Index		bw (kg) – 100 =  bwn (kg) . . . .  .  .    (3.5)
					echo "<tr><td colspan='2'>Broca Index</td><td colspan='2'>".$BroInd = 100 - $details[2]."</td></tr>";
//The Food to be Consumed per Day (fpd)
					echo "<tr><td colspan='2'>Total Food to be Consumed per Day (fpd)</td><td colspan='3'>".$fpd = $BroInd * $details[2]."</td></tr>";
					?>
				</table><table width="100%" border="1">
                	<tr><td colspan="3">QUANTIFICATION OF FOOD-PER-DAY</td></tr><?php
					echo"<tr style='background:#999;'>
						<th>Breakfast Proportion (fpd)</th><th>Lunch Proportion (fpd)</th><th colspan='2'>Dinner Proportion (fpd)</th></tr>";
					$formular = explode(":", $details[7]);
					$break = $formular[0]*$fpd/10;		$lunch=$formular[1]*$fpd/10;		$dinner=$formular[2]*$fpd/10;
					echo "<tr align='center'><td>$break KCal</td><td>$lunch KCal</td><td colspan='2'>$dinner KCal</td></tr>";
					echo "<tr align='center' style='font-size:12px' ><td colspan='5'>&nbsp;</td></tr>";					
					?>
				</table><table width="100%" border="1">
                	<tr><td colspan="4">DIET CONFIGURATIONS</td></tr>
					<tr align='center'><td>Diet</td><td>Carbohydrate</td><td>Protein</td><td>Fat</td></tr><?php
					$Diets = AskDBWhereMultiple("SELECT * FROM dietconfiguration");
					for($i=0; $i<count($Diets); $i++){										
						echo "<tr align='center' bgcolor='";
						if(strcasecmp($Diets[$i][1],$Diagnosis." Diet")==0){
							echo"#99CC99"; echo $Carb= $Diets[$i][2];
							$Prot = $Diets[$i][3]; $Fat = $Diets[$i][4];
						}
						echo"'><td>".$Diets[$i][1]."</td><td>".$Diets[$i][2]."%</td><td>".$Diets[$i][3]."%</td><td width='25%'>".$Diets[$i][4]."%</td></tr>";
					}                
					echo "<tr align='center'>
						<td colspan='5'>GRAM EQUIVALENT OF FOODS</td>
					</tr>";
					echo "<tr align='center' style='background:#999;'><td>Macro Food Nutrient for <br />$Diagnosis Diet</td>
							<td>Carbohydrate</td><td>Protein</td><td>Fat</td></tr>
					<tr align='center'>
						<td>Breakfast </th><td>".number_format(($Carb*$break)/(100*4),2)." Grams</td>
										   <td>".number_format(($Prot*$break)/(100*9),2)." Grams</td>
										   <td>".number_format(($Fat*$break)/(100*4),2)." Grams</td>
					</tr><tr align='center'>
						<td>Lunch </th><td>".number_format(($Carb*$lunch)/(100*4),2)." Grams</td>
										   <td>".number_format(($Prot*$lunch)/(100*4),2)." Grams</td>
										   <td>".number_format(($Fat*$lunch)/(100*4),2)." Grams</td>
					</tr><tr align='center'>
						<td>Dinner </th><td>".number_format(($Carb*$dinner)/(100*4),2)." Grams</td>
										   <td>".number_format(($Prot*$dinner)/(100*4),2)." Grams</td>
										   <td>".number_format(($Fat*$dinner)/(100*4),2)." Grams</td>
					</tr>";
				}
			?>
            </table></td><td width="50%" valign="top">
                <table width="100%" border="1">
					<?php
						echo "<tr><td colspan='2'>Name</td><td colspan='2'>".$p_info[1].", ".$p_info[2]."</td></tr>";
						echo "<tr><td colspan='2'>Gender (Age)</td><td colspan='2'>".$p_info[4]." (".$p_info[3].")</td></tr>";
						echo "<tr><td colspan='2'>Date of Diagnosis</td><td colspan='3'>".$details[8]."</td></tr>";
					?>  
				</table><table width="100%" border="1">             
                    <tr align='center'>
                        <th colspan="4">LIST OF FAVOURITES AND ALLERGIES PATIENT HAVE IN FOOD DATABASE</th>
                    </tr><tr align='center'>
                        <th colspan="2">Favourites</th>
                        <th colspan="2">Allegies</th>
                    </tr><tr align='center' valign="top">
						<td align="left" colspan="2"><ol style="block"><?php echo getFoods($p_info[14]); ?></ol></td>
						<td align="left" colspan="2"><ol style="block"><?php echo getFoods($p_info[15]); ?></ol></td>
					</tr>
                </table>
            </td></tr></table></td></form>
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