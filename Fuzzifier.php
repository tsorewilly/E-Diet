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
       	<table width="90%" align="center" cellspacing="1" class="label" border="1">
        	<tr><td colspan="14"><img src="images/Fuzz.png" width="100%" height="40" /></td></tr>
				<?php
					if($_POST){
						$Diagnosis = array('user_id','diag_id','cv','formular');
						$QueryResponse = TJInsert($Diagnosis,'diagnosis','Personalization.php?did='.$_POST[diag_id].'&done=Diagnosis Completed','yes', 'yes');
					}
                    if($_SESSION[uname]){
                        $p_info=AskDBWhereSingle("SELECT * FROM patientbio WHERE email=(SELECT email from users WHERE uname='".(@$_SESSION[uname])."')");
                         $p_data_array_sql = "SELECT bmi, al, bp, bs_value, bs_type, Id, userid, date FROM dietary_data WHERE userid='".$p_info[0]."'";
                        
                        $p_data_array = AskDBWhereMultiple($p_data_array_sql);
                        $tot_data = count($p_data_array);
						
                        if($_GET[id] and $_GET[id]!='')	$p_data=AskDBWhereSingle($p_data_array_sql." and Id = '".$_GET[id]."'");
                        else $p_data = $p_data_array[$tot_data-1];
                        
                        echo "<tr><td colspan='11'><label>Patient Name: ".$p_info[1]." ".$p_info[2]."<br/>Diagnosis Done on ".$p_data[7]."
							</label><input type='hidden' name='pid' value='".$p_info[0]."' /></td></tr>";  
                    }
                    elseif($_SESSION[type]!='Patient'){
                        echo "<tr><td colspan='4'>
                                <center>
                                    <h2>Session Expired</h2>Select A Patient To Continue Entry
                                    <select name='pid' onchange='form.submit()'>";
                                        LoadPatientsAndKeyNoTag('patientbio', 'userid', "CONCAT(Surname, ' ', Othernames)");
                        echo "</select></center></td></tr><tr><td colspan='4' class='section'>&nbsp;</td></tr>";
                    }
 
//FUZZIFY ALL INPUT DATA ()
					$para = array('bmi', 'al', 'bp', strtolower($p_data[4]));
                    $FuzzyValues = array();		$TFNValues = array();
                    for($i=0; $i<count($para); $i++){
//GET THE LINGUISTIC OF USERS INPUT
                        $FuzzyValues[$i] = getFuzzyValue("get".$para[$i], $p_data[$i]);
						$TFNValues[$i] = getTFN($FuzzyValues[$i]);
//							echo "<br />Linguistic of ".$para[$i]." with Value ".$p_data[$i]."=".$FuzzyValues[$i]." is ".getLing($para[$i], $FuzzyValues[$i] )."While TFN is ".implode(",", getTFN($FuzzyValues[$i] ));
                    }						
//					if($_GET[mn]) $min = $_GET[mn]; else $min = rand(0,70);
//					if($_GET[mx]) $max = $_GET[mx]; else $max= rand(70,150);					
					
                    $all_rules=AskDBWhereMultiple("SELECT bmi, al, bp, bs, result FROM rules");// LIMIT $min, $max");
//NOW LET'S CHECK FOR FIRED RULES	
                    $FireCount=0;		$FireRulesOutput='';	$AllRulesOutput='';
					$M = 0;				$S = 0;					$VS = 0;	
					for($i=0; $i<count($all_rules); $i++){
						$FiringTimes=0; $NZMV=1.0;
						$RulesOutput="<tr><td align='center'>".($i+1)."</td>";
						for($j=0; $j<count($para); $j++){
							if($FuzzyValues[$j]==(int)$all_rules[$i][$j]){								
								$FiringTimes+=1;
								if($_GET[view]=='fuzzy'){
									$Severity = SeverityDegree($FuzzyValues[$j],4);
/*CHECK FOR NON ZERO MIN VALUE*/	if($Severity>0){
										$RulesOutput.="<td align=center>$Severity</td>";
										if($Severity<$NZMV)	$NZMV = $Severity ;
									}else $RulesOutput.="<td align=center>-</td>";									
								}else $RulesOutput.="<td align='center'>".$FuzzyValues[$j]."</td>";
							} else $RulesOutput.="<td align='center'>-</td>";
						}
						$RulesOutput.="<td align='center'>".$all_rules[$i][4]."</td>";
						if($NZMV<1) $RulesOutput.="<td align='center'>$NZMV</td></tr>"; 		else $RulesOutput.="<td align='center'>-</td></tr>";						
//$RulesOutput.="<td align='center'>$FiringTimes Times</td></tr>"; 		
/*CHECKING FOR DISPLAYABLE RULES*/
						if($NZMV<1 and $FiringTimes>0 and $_GET[view]=='fuzzy'){
							$FireRulesOutput.=$RulesOutput; $FireCount++;
							switch($all_rules[$i][4]){
								case 'M':  $M  += pow($NZMV, 2); break;
								case 'S':  $S  += pow($NZMV, 2); break;
								case 'VS': $VS += pow($NZMV, 2); break;
							}
						}
						elseif($FiringTimes!=0) $AllRulesOutput.=$RulesOutput;
					}	
					if($_GET[view]=='fuzzy'){
						$cv = Defuzzify($M, $S, $VS);
						$status = classify($cv);
						$cv.='%';
					}//							echo "<tr><td>".$M."</td><td>".$S."</td><td>".$VS."</td><tr>";
					echo "<tr><td colspan='11'><label>Total Number of Rules Fired: $FireCount</td></tr>";                                
                ?>
                    <tr>
                        <th width="8%">Rule Id</th><th width="8%">BMI</th><th width="8%">AL</th><th width="8%">BP</th><th width="7%">BS</th>
                        <th width="8%">Result</th><th width="12%">Non Zero Min Val</th><th>&nbsp;</th>
                    </tr>
                <?php	/*DISPLAY FINAL OUTPUT*/if($FireRulesOutput!='')echo $FireRulesOutput;	else echo $AllRulesOutput;						

                    if($_GET[e]) $Msg = explode("~~~", $_GET[e]);
                    if($Msg)  echo "<cite id='queryTime'>Query Processed in: $Msg[2] Second(s)</cite><div id='$Msg[1]'>$Msg[0]</div>";
                ?>
                <input type='hidden' name='user_id' value='<?php echo $p_info[0]; ?>' /><input type='hidden' name='diag_id' value='<?php echo $p_data[5];?>'/>
            </table>
    </td>
    </td><td width="20%" valign="top">
        <table border="1" class="label">
            <?php
                echo "<tr><td colspan='2'><input type='button' style='height:40px; width:200px;' value='";
                    if($_GET[view]=='fuzzy')echo "Open Fuzzy numbers Variables' onclick='location.href=\"Fuzzifier.php?id=".$_GET[id]."\"' />";
                    else echo "Open Fuzzy Results' onclick='location.href=\"Fuzzifier.php?id=".$_GET[id]."&view=fuzzy\"' />";
                echo "<br /><button type='button' style='height:50px; width:200px;'>Select Eating Formular
					<select name='formular' align='center'>
						<option>4:3:3</option><option selected='selected'>3:4:3</option><option>3:3:4</option>
					</select></button>
                    <input type='submit' style='height:40px; width:200px;' value='Continue To Prediction' />
                    <input type='reset' style='height:40px; width:200px;' value='Exit System' onclick='location.href=\"index.php\"' /><br />
                    Diagnosis Status<input type='text' name='status' value='$status' style='height:40px; width:150px;' readonly='readonly' /><br />
                    Level of Severity <input type='text' name='cv' value='$cv' style='height:40px; width:150px;' readonly='readonly' />";
            ?>
            <img src="images/DietHistory.png" height="30" width="100%"  /> </td></tr>
            <tr><th>S/N</th><th>Date of Diagnosis</th></tr>
            <?php                            
                for($i=$tot_data-1; $i>=0; $i--)
                    echo "<tr onclick='location.href=\"Fuzzifier.php?id=".$p_data_array[$i][5]."\"' class='r".($i%2)."'><td align='center'>".
                    ($tot_data-$i)."</td><td align='center'>".$p_data_array[$i][7].
                    "</td></tr>";
            ?>
        </table>
    </td>
    </form>    	
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
