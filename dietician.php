<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="69%" align="center" border="">
<tr>
<?php include('hang.php'); ?>
      <td valign="top" width="70%">
       	<table width="68%" align="center" cellspacing="1" class="form" border="1">
        	<form method="post">
                <div class="db-query-report">
                    <?php
                        if($_POST){
							if(strpos($_POST[bp], '/')){
								$BPs = explode('/',$_POST[bp]);
								if($BPs[0]<$BPs[1])	echo "<div id='Warning'>Error in BP Input</div>";//TO ENSURE SYSTOLIC READING COMES FIRST
								$Patient = array('pid','ht','wt','bmi','al','bp','bs_type','bs_value');								
								$QueryResponse = TJInsert($Patient,'dietary_data','Fuzzifier.php?done=Information Captured For Fuzzification','yes','yes');
							}else echo "<div id='Error'>Error in BP Input</div>";
                        }
                        if($_SESSION[uname]){	
                            $Patient=AskDBWhereSingle("SELECT * FROM patientbio WHERE email=(SELECT email from users WHERE uname='".(@$_SESSION[uname])."')");
                            echo "<tr><td width='23%' align='right'><label>Patient Name</label></td><td colspan='3'>".spaces(5).$Patient[1]." ".$Patient[2]."
                                    <input type='hidden' name='pid' value='".$Patient[0]."' /></td></tr>";
                        }
                        elseif($_SESSION[type]!='Patient'){
                            echo "<tr><td colspan='4'><center><h2>Session Expired</h2>Select A Patient To Continue Entry";
                            LoadPatientsAndKey('patientbio', 'pid', 'userid', "CONCAT(Surname, ' ', Othernames)");
                            echo "</center></td></tr><tr><td colspan='4' class='section'>&nbsp;</td></tr>";
                        }
                        
                        if($_GET[e]) $Msg = explode("~~~", $_GET[e]);
                        if($Msg)  echo "<cite id='queryTime'>Query Processed in: $Msg[2] Second(s)</cite><div id='$Msg[1]'>$Msg[0]</div>";
                    ?> 
                </div>                   
                </tr><tr>
                	<td colspan="4"><img src="images/AandL.png" width="100%" height="40" /></td>
                </tr><tr>
                    <td><label>Body Height (M)</label></td><td><input type="text" name="ht" id="ht" class="" maxlength="5" /> </td>                   
                </tr><tr>
                    <td width="24%"><label>Body Weight (KG)</label></td><td><input type="text" name="wt" onblur="get('bmi').value=dividetags(this, 'ht')" />								
                    				<input type="hidden" name="bmi" id="bmi" class="" maxlength="5" /> </td>
                </tr><tr>
                    <td colspan="4" class="section">Please Carefully Indicate Your Profession Category</td>
                </tr><tr>
                    <td colspan="4"><label>Category of Profession<font color="#990000"> <?php
						if(checkALClass()=="Sedentary"){ echo "Office Based Works"; $al=array(20,25,30); }
						if(checkALClass()=="Active"){ echo "Construction/Site Works";  $al=array(25,30,35); }
						if(checkALClass()=="Very Active"){ echo "Non-Mechanized Agriculturist/Professional Sport Person";  $al=array(30,35,40); }
					?>
                    </font><br />Level of Activeness</label>
                    	<select name="al"><?php foreach($al as $a) echo "<option>$a</option>";?></select>
                    </td>
				</tr><tr>
                    <td><label>Blood Pressure</label></td><td><input type="text" name="bp" id="bp" class="" maxlength="10" /> (Format: Sys/Dia)</td>
                </tr><tr>
                    <td><label>Choose Blood Sugar Test</label></td>
                   	<td><select name="bs_type">
                        	<option value="FBS">Fasting Value</option>
                            <option value="RBS">Post Prandial</option>
                            <option value="HBA">Glycated Haemoglobin</option>
                        </select>
                    </td>                   
				</tr><tr>
                    <td><label>Result</label></td><td><input type="text" name="bs_value" id="bs_value" class="" maxlength="10" /> </td>
                </tr><tr>
                    <td align="center" colspan="4">
                        <input type="submit" class="" value="Save Information" />
                        <input type="reset" class="" value="Clear Information" />
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