<?php
	function checkInt($val){
		echo (int)$val;
		if($val>0)	return '1';		else return '2';
	}

	function getId($tab){
		$d = getdate();
		$IdNum = "$d[year]$d[mon]$d[wday]$d[mday]$d[hours]$d[minutes]$d[seconds]";
		return strtoupper(substr($tab,0,3).substr($tab,-1,1)).$IdNum;
	}
	
	function getFoods($Ids){
		$Ids = substr($Ids, 0, strlen($Ids)-1);
		$FoodIds = explode('~', $Ids);
		foreach($FoodIds as $food){
			$FoodDetails=AskDBWhereSingle("SELECT * FROM food WHERE Id ='$food'");
			echo "<li title='Constituents Per 100 Gram: ".$FoodDetails[2]."G Carbohydrates, ".$FoodDetails[3]."G Protein and ".$FoodDetails[4]."G Fats'>
				".$FoodDetails[1].
			"</li>";
		}	
	}
	
	function SeverityDegree($val, $max){
		$a = 4/rand(1,3);
		return number_format((($val - $a)/$max),2);
	}
	function getMsgs($var){
		if(!$var) return;
		elseif(is_array($var)){
			for($k=0; $k<=count($var); $k++){
//				$Msg = explode("~~~", $var[$k]);
				echo "<div id='queryTime'>".$var[$k]."</div>";
			}
		}else{
			$Msg = explode("~~~", $QueryResponse);
			echo "<cite id='queryTime'>Query Processed in: $Msg[2] Second(s)</cite><div id='$Msg[1]'>$Msg[0]</div>";		
		}
	}
	function getFuzzyValue($FuncToLoad, $Value){
//	echo "$FuncToLoad for $Value<br />";
		if(function_exists($FuncToLoad)) 	$THIS_TFN=$FuncToLoad($Value);
		else 								"Echo Function: $FuncToLoad Does Not Exist";
		return $THIS_TFN;
	}
	
	function Defuzzify($M, $S, $VS){
		$M = sqrt($M);	$S=sqrt($S);	$VS=sqrt($VS);//		echo "<tr><td>".$M."</td><td>".$S."</td><td>".$VS."</td><tr>"; 
		$diagnosis = (($M * 0.2) + ($S * 0.5) + ($VS * 0.9))/($M + $S + $VS);
		return number_format($diagnosis*100, 3);
	}
	
	function getTFN($Linguistic){
			if($Linguistic==1 or $Linguistic==1.1 or $Linguistic=='VeryLow')								$TFN=array(0, 1, 2);
		elseif($Linguistic==2 or $Linguistic==1.2 or $Linguistic==2.1 or $Linguistic=='Low')				$TFN=array(1, 2, 3);
		elseif($Linguistic==3 or $Linguistic==1.3 or $Linguistic==2.2 or $Linguistic=='MediumLow')			$TFN=array(2, 3, 4);
		elseif($Linguistic==4 or $Linguistic==2.3 or $Linguistic=='Medium')									$TFN=array(3, 4, 5);
		elseif($Linguistic==5 or $Linguistic==3.1 or $Linguistic=='MediumHigh')								$TFN=array(4, 5, 6);
		elseif($Linguistic==6 or $Linguistic==3.2 or $Linguistic=='High')									$TFN=array(5, 6, 7);
		elseif($Linguistic==7 or $Linguistic==3.3 or $Linguistic=='VeryHigh')								$TFN=array(6, 7, 8);
		else																								$TFN=array(0, 0, 0);
		return $TFN;
	}
		
	
	function getLing($para, $val){
//		echo "$para for $val<br />";
			if($para=='bmi')
				switch($val){case 1: $Ling="Under weight"; break; case 2: $Ling="Healthy weight"; break; case 3: $Ling="Overweight"; break; 	case 4: $Ling="Obese"; break; }
			elseif($para=='al')
				switch($val){case 1: $Ling=""; break; case 2: $Ling=""; break; case 3: $Ling=""; break; case 4: $Ling=""; break; }
			elseif($para=='bp')
				switch($val){case 1: $Ling="Mild Hypertension";break; case 2: $Ling="Moderate Hypertension";break; case 3: $Ling="Severe Hypertension";break;}
			elseif($para=='fbs' or $para=='rbs' or $para=='hba')
				switch($val){case 1: $Ling="Normal"; break; case 2: $Ling="Pre diabetes"; break; case 3: $Ling="Established Diabetes"; break; }
			elseif($para=='bs_post')
				switch($val){case 1: $Ling="Normal"; break; case 2: $Ling="Pre diabetes"; break; case 3: $Ling="Established Diabetes"; break; }
			elseif($para=='crt')
				switch($val){case 1: $Ling="Normal"; break;  case 2: $Ling="High"; break; }
			elseif($para=='lpt')
				switch($val){case 1: $Ling="Normal"; break; case 2: $Ling=""; break;	case 3: $Ling=""; break; 	case 4: $Ling=""; break; }
			elseif($para=='hba1c')
				switch($val){case 1: $Ling="Normal"; break; 	case 2: $Ling="Pre-diabetes"; break; case 3: $Ling="Established Diabetes"; break; }
		return $Ling;
	}
	
	function getbmi($val){
		$value = (float)$val;
		switch($value){
			case($value<=1.3):						$bmi=1;	break;
			case($value> 1.3 and $value<=2.5):		$bmi=2;	break;
			case($value> 2.5 and $value<=3.0):		$bmi=3;	break;
			case($value>3.0):						$bmi=4;	break;
		}
		return $bmi;		
	}
	
	function checkALClass(){
		$Prof=AskDBWhereSingle("SELECT Profession FROM patientbio WHERE email=(SELECT email from users WHERE uname='".(@$_SESSION[uname])."')");
		return $Prof[0];
	}
	
	function getal($val){
		$Prof=checkALClass();
		$value = (int)$val;		
		if(($value== 20 and $Prof=='Sedentary') or ($value== 25 and $Prof=='Active') or ($value== 30 and $Prof=='Very Active')) 			$al=1;
		elseif(($value== 25 and $Prof=='Sedentary') or ($value== 30 and $Prof=='Active') or ($value== 35 and $Prof=='Very Active')) 		$al=2;
		elseif(($value== 30 and $Prof=='Sedentary') or ($value== 35 and $Prof=='Active') or ($value== 40 and $Prof=='Very Active'))		$al=3;
		return $al;		
	}
	
	function getbp($val){
		$value = explode('/', $val);
		    if($value[0]<=120 and $value[1] <=80)											$bp=1;
		elseif($value[0]<=120 and ($value[1]>=81 and $value[1]<=90))						$bp=1;
		elseif($value[0]<=120 and $value[1]>=91)											$bp=2;
		elseif(($value[0]>120 and $value[0]<=140) and $value[1]<=80)						$bp=2;
		elseif(($value[0]>120 and $value[0]<=140) and ($value[1]>=81 and $value[1]<=90))	$bp=2;
		elseif(($value[0]>120 and $value[0]<=140) and $value[1]>=91)						$bp=3;
		elseif($value[0]>140 and $value[1]<=80)												$bp=2;
		elseif($value[0]>140 and ($value[1]>=81 and $value[1]<=90))							$bp=3;
		elseif($value[0]>140 and $value[1]>=91)												$bp=4;
		return $bp;				
	}
		
	function getfbs($val){
		$value = (int)$val;
		switch($value){
			case($value<=100):					$bs_fast=1;	break;
			case($value>=101 and $value<=125):	$bs_fast=2;	break;
			case($value>=126):					$bs_fast=3;	break;
		}
		return $bs_fast;						
	} 
	
	function getrbs($val){
		$value = (int)$val;
		switch($value){
			case($value<=140):					$bs_post=1;	break;
			case($value>=141 and $value<=199):	$bs_post=2;	break;
			case($value>=200):					$bs_post=3;	break;
		}
		return $bs_post;						
	} 
	
	function gethba($val){
		$value = (float)$val;
		switch($value){
			case($value<=5.6):					$hba1c=1;	break;
			case($value>=5.7 and $value<=6.4):	$hba1c=2;	break;
			case($value>=6.5 ):					$hba1c=3;	break;
		}
		return $hba1c;								
	}
	
	/*function getlp_chol($val){
		$value = (int)$val;
		switch($value){
			case($value<=199):					$lp_chol=1;	break;
			case($value>=200 and $value<=239):	$lp_chol=2;	break;
			case($value>=240):					$lp_chol=3;	break;
		}
		return $lp_chol;				
	}
	
	function getlp_ldl($val){
		$value = (int)$val;
		switch($value){
			case($value<=99):					$lp_ldl=1;	break;
			case($value>=100 and $value<=159):	$lp_ldl=2;	break;
			case($value>=160):					$lp_ldl=3;	break;
		}
		return $lp_ldl;				
	}

	function getlp_f_trig($val){
		$value = (int)$val;
		switch($value){
			case($value<=100):					$lp_f_trig=1;	break;
			case($value>=150 and $value<=399):	$lp_f_trig=2;	break;
			case($value>=400):					$lp_f_trig=3;	break;
		}
		return $lp_f_trig;				
	}	
	
	function getcrt($val){
		$value = (int)$val;
		switch($value){
			case($value<133):	$crt=1;	break;
			case($value>=133):	$crt=2;	break;
		}
		return $crt;								
	} */
	
	
	function getMonths($index=-1){
		$months = array("","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");	
		if($index==-1){
			for($k=1; $k<=count($months); $k++){
				$l = ((strlen($k)==1)?("0".$k):$k);
				if($months[index]==$months[$k]) 	@$opt.="<option value='$l' selected='1'>$months[$k]</option>";
				else 								@$opt.="<option value='$l'>$months[$k]</option>";
			}
		}else	@$opt=$months[$index];
		return $opt;
	}
	
	function spaces($no){
		for($k=1; $k<=$no; $k++) $spaces.="&nbsp;";
		return $spaces;
	}
	
	function getShortDate($var=""){
		$d = getdate();
		$mon = ((strlen($d[@mon]) ==1)?("0".@$d[mon]):@$d[mon]);
		$day = ((strlen($d[@mday]) < 2)?("0".@$d[mday]):@$d[mday]);
		if ($var =="") 		$yr = @$d[year];
		elseif($var > 0)	$yr = @$d[year]-$var;
		elseif($var < 0)	$yr = @$d[year]+$var;
		return $date = "$yr-$mon-$day";
	}
	
	function DateTime(){
		$d = getdate();		return "$d[year]-$d[mon]-$d[mday] $d[hours]:$d[minutes]:$d[seconds]";
	}
	
	function setYear(){
		$d = getdate();		return "$d[year]";
	}

	function getStates(){
//		$states = AskDBWhereMultiple("SELECT * FROM states");
		echo "<option selected='1'></option>";		
		for($k=0; $k<count($states); $k++) echo "<option value='".$states[$k][1]."'>".ucwords(strtolower($states[$k][0]))."</option>";	
	}
	
	function loadAccountTypes($SQL){
//		$Rows=AskDBWhereMultiple($SQL);
		echo "<option selected='1'></option>";		
		for($k=0; $k<count($Rows); $k++) echo "<option value='".$Rows[$k][1]."'>".$Rows[$k][1]."</option>";		
	}
	
	function getPageName(){
		$paths = explode("/",$_SERVER['PHP_SELF']);	
		return strtolower($paths[count($paths)-1]);
	}

	function resizeImage($image, $size){
		$size=filesize($image);		
		$src = imagecreatefromjpeg($image);		
		list($width,$height)=getimagesize($image);
		
		$newwidth=150;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);					
		imagejpeg($tmp,$image,100);		
		imagedestroy($src);
		imagedestroy($tmp);
	}
	
	function Login($Uname, $Upass, $UType){
		$UserRecSQL="SELECT * FROM users WHERE uname='".$Uname."' AND pass='".md5($Upass)."' AND type='".$UType."'";
		if(ConfirmRecord($UserRecSQL)>0)	return true;
		else return false;
	}

	function LoadPatientsAndKey($Table, $TagName, $Key, $Fields){
		$REC_SET = AskDBWhereMultiple("SELECT $Key, $Fields FROM $Table");
		$Recs="<select name='$TagName'><option></option>";
		if($REC_SET > 0){
			for($i=0; $i<count($REC_SET); $i++) $Recs.="<option value='".$REC_SET[$i][0]."'>".$REC_SET[$i][1]."</option>";
		}else{
			echo $Recs.="<option>No Patient Records Found</option></select>";		
		}
		echo $Recs.="</select>";
	}
	
	function LoadPatientsAndKeyNoTag($Table, $Key, $Fields){
		$REC_SET = AskDBWhereMultiple("SELECT $Key, $Fields FROM $Table");
		$Recs="<option></option>";
		if($REC_SET > 0){
			for($i=0; $i<count($REC_SET); $i++) $Recs.="<option value='".$REC_SET[$i][0]."'>".$REC_SET[$i][1]."</option>";
		}else{
			echo $Recs.="<option>No Patient Records Found</option></select>";		
		}
		echo $Recs;
	}
	
	function AskDBWhereSingle($FullWhereClause){
//		echo $FullWhereClause; echo "<br />";
		$SQL_QUERY = $FullWhereClause;
		$QUERY_DB = mysql_send_query($SQL_QUERY);
		$ROW_NUM = mysql_num_rows($QUERY_DB);
		$Result = array();
		if($ROW_NUM==0){return " ";}
		else{
			for($i=0; $i<$ROW_NUM; $i++){
				$REC_SET = mysql_fetch_array($QUERY_DB);
					$PROC_REC_SET= array();
					for($j=0; $j<count($REC_SET); $j++){
						$PROC_REC= trim(stripslashes(strip_tags(@$REC_SET[$j])));
						$PROC_REC_SET[]=$PROC_REC;
					}
				$Result[]=$PROC_REC_SET;
			}
			return $Result[0];
		}
	}
	
	function AskDBWhereMultiple($FullWhereClause){
//		echo $FullWhereClause;
 		$SQL_QUERY = $FullWhereClause;
		$QUERY_DB = mysql_send_query($SQL_QUERY);
		$ROW_NUM = mysql_num_rows($QUERY_DB);
		$Result = array();
		if($ROW_NUM ==0){return " ";}
		else{
			for($i=0; $i<$ROW_NUM; $i++){
				$REC_SET = mysql_fetch_array($QUERY_DB);
					$PROC_REC_SET= array();
					for($j=0; $j<count($REC_SET); $j++){
						$PROC_REC= trim(stripslashes(strip_tags(@$REC_SET[$j])));
						$PROC_REC_SET[]=$PROC_REC;
					}
				$Result[]=$PROC_REC_SET;
			}
			return $Result;
		}
	}
	
	function getMyDetails($table, $key, $value){
//		echo "SELECT * FROM $table WHERE $key = '".$value."'";
		return AskDBWhereSingle("SELECT * FROM $table WHERE $key = '".$value."'");
	}
	
	function getTableColumnName($SQL){
		$QUERY_DB = mysql_send_query($SQL);
		$NUM_FLDS = mysql_num_fields($QUERY_DB);
		for($fieldIndex=0; $fieldIndex<$NUM_FLDS; $fieldIndex++)
			$ColumnNames[] = mysql_field_name($QUERY_DB, $fieldIndex);	
		return $ColumnNames;
	}
	
	function TJInsert($arr, $tab, $loc, $useNull="no", $useCurDate="no", $BuiltQuery='no'){
		$querytime_before=array_sum(explode(' ', microtime()));
		if($BuiltQuery=='no'){
			$strInp ='';	$strVal='';
			for($i=0;$i<count($arr);$i++){
				$strInp = $strInp.$arr[$i].', ';
				if(substr_count(strtolower($arr[$i]), "password")>0)	$strVal = $strVal.'\''.md5($_POST[$arr[$i]]).'\', ';
				elseif(strtoupper($arr[$i])=='NULL')	{$strVal = $strVal.'NULL, ';}
				else{$strVal = $strVal.'\''.addslashes(@$_POST[$arr[$i]]).'\', ';}				
			}
			$strInp."<br />".$strVal;
			$strInp = str_Formart($strInp,strlen($strInp)-2);
			$strVal = str_Formart($strVal,strlen($strVal)-2);
			if($useNull=="yes"){ $p = getId($tab); $strVal = "'".$p."', ".$strVal; $_SESSION[pid]=$p;}
			if($useCurDate=="yes") $strVal = $strVal.", '".getShortDate()."'";
		}else $strVal = "'".$BuiltQuery."'";
		$Sql_Query = "INSERT INTO $tab Values ($strVal)";					//		echo ($Sql_Query); 	exit;
		if(mysql_send_query($Sql_Query)){
			$querytime_after = array_sum(explode(' ', microtime()));
			$querytime= number_format((float)$querytime_after - (float)$querytime_before,'3','.',',');
			$msg = "RECORD SAVED SUCCESSFULLY?e=Suxes~~~".$querytime;
		}else{
			switch((int)mysql_errno()){
				case 1062:	$msg = "DATA ALREADY EXIST IN FILE.";											break;
				case 1146:	$msg = "ONE DATABASE SCHEMA IS HAVING ISSUES";									break;
				case 1136:	$msg = "COLUMN COUNT DOES NOT MATCH VALUE COUNT IN DATABASE TABLE";				break;
				default: 	$msg = "#".mysql_error().": AN UNDEFINED ERROR OCCURED PLEASE TRY AGAIN.";		break;
			}
			if($msg!='') echo "<script>alert('Information Entry Failed'); location.href='".$loc."?e=".$msg."'</script>";
		}	
		if($loc!='') echo "<script>alert('Record Saved Successfully'); location.href='".$loc."?e=".$msg."'</script>";
		return $msg;

	}
		
	function TJDelete($SQL_QUERY){
//		echo $SQL_QUERY;
		if(mysql_send_query($SQL_QUERY))	echo "<tr><td class=\"SuxesMsg\" colspan='10' width='100%'>PRODUCT SUCCESSFULLY DELETED.</td></tr>";
		else echo "<tr><td class=\"AlertMsg\" colspan='10' width='100%'>PRODUCT COULD NOT BE DELETED.</td></tr>";
	}
	
	function mysql_send_query($query){
		connect();//		echo $query;
		return mysql_query($query);
	}
	function connect(){
		mysql_connect('localhost','root','') or die ("Could not connect to localhost");
		mysql_select_db('dietary') or die ("Database Selection Failed, Check Connection String");
	}
	
	function ConfirmRecord($FullWhereClause){
	//	echo "<br />".
		$SQL_QUERY = $FullWhereClause;
		$QUERY_DB = mysql_send_query($SQL_QUERY) or die(mysql_error());
		/*echo "Number Confirmed = ".*/
		$ROW_NUM = mysql_num_rows($QUERY_DB);
		return $ROW_NUM;
	}
	
	function str_Formart($str,$len){
		return substr(trim($str),0,$len);	
	}

	function TJUpdate($keyClause,$arr,$tab,$loc,$dupMsg="no"){
		$strVal='';
		for($i=0;$i<count($arr);$i++){
			if(substr_count(strtolower($arr[$i]), "password")>0)	$strVal = $strVal.$arr[$i]."=".'\''.md5($_POST[$arr[$i]]).'\', ';
			elseif(strtoupper($_POST[$arr[$i]])=='NULL')	{$strVal = $strVal.$arr[$i]."=".''.$_POST[$arr[$i]].', ';}
			else{$strVal = $strVal.$arr[$i]."=".'\''.addslashes($_POST[$arr[$i]]).'\', ';}
		}
		$strVal = str_Formart($strVal,strlen($strInp)-1);
		$Sql_Query = "UPDATE $tab SET $strVal WHERE $keyClause";
//		echo "<br />".$Sql_Query;	exit;			// this line is to print the number of fields binded to the database
		if(mysql_send_query($Sql_Query))
			if (mysql_affected_rows()>0){
				if($dupMsg=="no"){
					$dupMsg="RECORD WAS SUCCESSFULLY UPDATED";
					echo "<tr><td class=\"SuxesMsg\" colspan='2' width='100%'>".$dupMsg."</td></tr>";
				}
				else echo $dupMsg;
				
				if(trim($loc)=="") return true;
				else{
					if($dupMsg=="no")echo "<script>location.href='".$loc."'</script>";
					else echo "<script>location.href='".$loc."?Msg=".$dupMsg."'</script>";
				}
			}else echo "<script>location.href='".$loc."'</script>";
		else echo "<tr><td class=\"AlertMsg\" colspan='2' width='100%'>UPDATE QUERY COULD NOTN BE PERFROMED ON THE DATABASE.</td></tr>";
	}

	function TJUpdateSql($SQL){
//		echo "<br />".$SQL;
		if(mysql_send_query($SQL)){
			if (mysql_affected_rows()>0) return true;
			else return "No Record Was Updated";
		}else return false;
	}

	function SearchAndFound($arr, $tab){
		$querytime_before = array_sum(explode(' ', microtime()));
		$strInp ='';	$strVal='';
		for($i=0;$i<count($arr);$i++){
			if(substr_count(strtolower($arr[$i]), "password")>0)	$strVal = "'".md5($_POST[$arr[$i]])."'";
			elseif(strtoupper(@$_POST[$arr[$i]])=='NULL')			$strVal = "'".$_POST[$arr[$i]]."'";
			else													$strVal = "'".addslashes(@$_POST[$arr[$i]])."'";
			$strInp = $strInp.$arr[$i].'='.$strVal.' AND ';
		}
		$strInp = str_Formart($strInp, strlen($strInp)-4);
		$Sql_Query = "SELECT * FROM $tab WHERE ($strInp)";
		if(mysql_num_rows(mysql_send_query($Sql_Query))>0) return true;
		else return false;
	}

	function TJLogout($username, $addr){
		if($username!=""){
			unflagUser($username);
			session_destroy();
			session_unset();
		}else $addr."&& msg=You Have To Log Into The Account Before You Can Log Out";
		header('location:'.$addr);
	}
	
	function querytime_before(){return array_sum(explode(' ', microtime()));} // $querytime_before = 
	function querytime_after(){return array_sum(explode(' ', microtime()));} // $querytime_after=
	//------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------
	
	function result($query){
		if(!$result=mysql_send_query($query)){	return mysql_error();	}	
		else return $result;
	}	

	function classify($val){
		if($val<35.1) 						return "Normal";	
		elseif($val>35.0 and $val <65.1)	return "Mild Diabetic";	
		elseif($val>65.0 and $val <85.1)	return "Severe Diabetic";	
		elseif($val>85.0)					return "Very Severe Diabetic";									
	}
	
	function getLoadFoods($Table, $Fields){
		$REC_SET = AskDBWhereMultiple("SELECT $Fields FROM $Table");
		$Recs="";
		if($REC_SET > 0) for($i=0; $i<count($REC_SET); $i++) $Recs.="<option value='".$REC_SET[$i][0]."'>".$REC_SET[$i][1]."</option>";
		else		echo $Recs.="<option>No Patient Records Found</option></select>";		
		return $Recs;
	}
?>