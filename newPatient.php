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
       	<table width="70%" align="center" cellspacing="1" class="form" border="1">
        	<form method="post">
                <tr><td colspan="4"><img src="images/prp.png" width="100%" height="40" /></td></tr>
                	<div class="db-query-report">
                    <?php
                        if($_POST){
                            $Patient=array('sname','oname','age','sex','mstatus','fone','prof','address','lga','nation','kin-name','kin-fone',
										'email','Favourites','Allergics','null');
                            $Login = array('uname','password','type','email');
                            $QueryResponse[0] = TJInsert($Patient, 'patientbio', getPageName(), 'yes', 'yes');
                            $QueryResponse[1] = TJInsert($Login, 'users', getPageName(), 'yes', 'yes');
							getMsgs($QueryResponse);
                        }
						if($_GET){
							getMsgs($_GET[e]);
/*                            $Msg = explode("~~~", $_GET[e]);
                            echo "<cite id='queryTime'>Query Processed in: $Msg[2] Second(s)</cite><div id='$Msg[1]'>$Msg[0]</div>";
*/						}

                    ?> 
                    </div>                   
                <tr>
                    <td width="20%"><label>Surname</label></td><td><input type="text" name="sname" id="" class="" maxlength="15" /> </td>
                    <td><label>Othernames</label></td><td><input type="text" name="oname" id="" class="" maxlength="20" /> </td>
                </tr><tr>
                    <td><label>Age</label></td><td><input type="text" name="age" id="" class="" maxlength="3" /> </td>
                    <td><label>Gender</label></td><td><select name="sex"><option>Male</option><option>Female</option></select> </td>
                </tr><tr>
                    <td><label>Marital Status</label></td>
                    <td>
                        <select name="mstatus">
                        
                            <option></option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </td>
                    <td><label>Phone No</label></td><td><input type="text" name="fone" id="" class="" maxlength="15" /> </td>
                </tr><tr>
                    <td><label>Address</label></td><td><textarea name="address" id="" class="" cols="29" rows="2"></textarea> </td>
                    <td><label>Email</label></td><td><input type="text" name="email" maxlength="30" /> </td>                    
                </tr><tr>
                    <td><label>Local Government Area</label></td><td><input type="text" name="lga" id="" class="" maxlength="15" /> </td>
                    <td><label>Nationality</label></td><td>
                        <select name="nation">
                            <option value="">---SELECT---</option>
                            <option value="AF">AFGHANISTAN</option>
                            <option value="AX">ALAND ISLANDS</option>
                            <option value="AL">ALBANIA</option>
                            <option value="DZ">ALGERIA</option>
                            <option value="AS">AMERICAN SAMOA</option>
                            <option value="AD">ANDORRA</option>
                            <option value="AO">ANGOLA</option>
                            <option value="AI">ANGUILLA</option>
                            <option value="AQ">ANTARCTICA</option>
                            <option value="AR">ARGENTINA</option>
                            <option value="AM">ARMENIA</option>
                            <option value="AW">ARUBA</option>
                            <option value="AU">AUSTRALIA</option>
                            <option value="AT">AUSTRIA</option>
                            <option value="AZ">AZERBAIJAN</option>
                            <option value="BS">BAHAMAS</option>
                            <option value="BH">BAHRAIN</option>
                            <option value="BD">BANGLADESH</option>
                            <option value="BB">BARBADOS</option>
                            <option value="BY">BELARUS</option>
                            <option value="BE">BELGIUM</option>
                            <option value="BZ">BELIZE</option>
                            <option value="BJ">BENIN</option>
                            <option value="BM">BERMUDA</option>
                            <option value="BT">BHUTAN</option>
                            <option value="BO">BOLIVIA</option>
                            <option value="BQ">BONAIRE</option>
                            <option value="BA">BOSNIA AND HERZEGOWINA</option>
                            <option value="BW">BOTSWANA</option>
                            <option value="BV">BOUVET ISLAND</option>
                            <option value="BR">BRAZIL</option>
                            <option value="BN">BRUNEI DARUSSALAM</option>
                            <option value="BG">BULGARIA</option>
                            <option value="BF">BURKINA FASO</option>
                            <option value="BI">BURUNDI</option>
                            <option value="KH">CAMBODIA</option>
                            <option value="CM">CAMEROON</option>
                            <option value="CA">CANADA</option>
                            <option value="CV">CAPE VERDE</option>
                            <option value="KY">CAYMAN ISLANDS</option>
                            <option value="CF">CENT. AFRICAN REPUBLIC</option>
                            <option value="TD">CHAD</option>
                            <option value="CL">CHILE</option>
                            <option value="CN">CHINA</option>
                            <option value="CX">CHRISTMAS ISLAND</option>
                            <option value="CC">COCOS ISLANDS</option>
                            <option value="CO">COLOMBIA</option>
                            <option value="KM">COMOROS</option>
                            <option value="CG">CONGO</option>
                            <option value="CD">CONGO DRC</option>
                            <option value="CK">COOK ISLANDS</option>
                            <option value="CR">COSTA RICA</option>
                            <option value="CI">COTE D'IVOIRE</option>
                            <option value="HR">CROATIA</option>
                            <option value="CU">CUBA</option>
                            <option value="CW">CURACAO</option>
                            <option value="CY">CYPRUS</option>
                            <option value="CZ">CZECH REPUBLIC</option>
                            <option value="DK">DENMARK</option>
                            <option value="DJ">DJIBOUTI</option>
                            <option value="DM">DOMINICA</option>
                            <option value="DO">DOMINICAN REPUBLIC</option>
                            <option value="TP">EAST TIMOR</option>
                            <option value="EC">ECUADOR</option>
                            <option value="EG">EGYPT</option>
                            <option value="SV">EL SALVADOR</option>
                            <option value="GQ">EQUATORIAL GUINEA</option>
                            <option value="ER">ERITREA</option>
                            <option value="EE">ESTONIA</option>
                            <option value="ET">ETHIOPIA</option>
                            <option value="FK">FALKLAND ISLANDS</option>
                            <option value="FO">FAROE ISLANDS</option>
                            <option value="FJ">FIJI</option>
                            <option value="FI">FINLAND</option>
                            <option value="FR">FRANCE</option>
                            <option value="GA">GABON</option>
                            <option value="GM">GAMBIA</option>
                            <option value="GE">GEORGIA</option>
                            <option value="DE">GERMANY</option>
                            <option value="GH">GHANA</option>
                            <option value="GI">GIBRALTAR</option>
                            <option value="GR">GREECE</option>
                            <option value="GL">GREENLAND</option>
                            <option value="GD">GRENADA</option>
                            <option value="GP">GUADELOUPE</option>
                            <option value="GU">GUAM</option>
                            <option value="GT">GUATEMALA</option>
                            <option value="GG">GUERNSEY</option>
                            <option value="GN">GUINEA</option>
                            <option value="GW">GUINEA-BISSAU</option>
                            <option value="GY">GUYANA</option>
                            <option value="HT">HAITI</option>
                            <option value="VA">VATICAN CS</option>
                            <option value="HN">HONDURAS</option>
                            <option value="HK">HONG KONG</option>
                            <option value="HU">HUNGARY</option>
                            <option value="IS">ICELAND</option>
                            <option value="IN">INDIA</option>
                            <option value="ID">INDONESIA</option>
                            <option value="IR">IRAN</option>
                            <option value="IQ">IRAQ</option>
                            <option value="IE">IRELAND</option>
                            <option value="IM">ISLE OF MAN</option>
                            <option value="IL">ISRAEL</option>
                            <option value="IT">ITALY</option>
                            <option value="JM">JAMAICA</option>
                            <option value="JP">JAPAN</option>
                            <option value="JE">JERSEY</option>
                            <option value="JO">JORDAN</option>
                            <option value="KZ">KAZAKHSTAN</option>
                            <option value="KE">KENYA</option>
                            <option value="KI">KIRIBATI</option>
                            <option value="KP">KOREA, D.P.R.O.</option>
                            <option value="KR">REPUBLIC OF KOREA</option>
                            <option value="KW">KUWAIT</option>
                            <option value="KG">KYRGYZSTAN</option>
                            <option value="LA">LAOS</option>
                            <option value="LV">LATVIA</option>
                            <option value="LB">LEBANON</option>
                            <option value="LS">LESOTHO</option>
                            <option value="LR">LIBERIA</option>
                            <option value="LY">LIBYA</option>
                            <option value="LI">LIECHTENSTEIN</option>
                            <option value="LT">LITHUANIA</option>
                            <option value="LU">LUXEMBOURG</option>
                            <option value="MO">MACAU</option>
                            <option value="MK">MACEDONIA</option>
                            <option value="MG">MADAGASCAR</option>
                            <option value="MW">MALAWI</option>
                            <option value="MY">MALAYSIA</option>
                            <option value="MV">MALDIVES</option>
                            <option value="ML">MALI</option>
                            <option value="MT">MALTA</option>
                            <option value="MH">MARSHALL ISLANDS</option>
                            <option value="MQ">MARTINIQUE</option>
                            <option value="MR">MAURITANIA</option>
                            <option value="MU">MAURITIUS</option>
                            <option value="YT">MAYOTTE</option>
                            <option value="MX">MEXICO</option>
                            <option value="MC">MONACO</option>
                            <option value="MN">MONGOLIA</option>
                            <option value="ME">MONTENEGRO</option>
                            <option value="MS">MONTSERRAT</option>
                            <option value="MA">MOROCCO</option>
                            <option value="MZ">MOZAMBIQUE</option>
                            <option value="MM">MYANMAR (BURMA)</option>
                            <option value="NA">NAMIBIA</option>
                            <option value="NR">NAURU</option>
                            <option value="NP">NEPAL</option>
                            <option value="NL">NETHERLANDS</option>
                            <option value="AN">NETHERLANDS ANTILLES</option>
                            <option value="NC">NEW CALEDONIA</option>
                            <option value="NZ">NEW ZEALAND</option>
                            <option value="NI">NICARAGUA</option>
                            <option value="NE">NIGER</option>
                            <option value="NG">NIGERIA</option>
                            <option value="NU">NIUE</option>
                            <option value="NF">NORFOLK ISLAND</option>
                            <option value="MP">NORTHERN MARIANA ISLANDS</option>
                            <option value="NO">NORWAY</option>
                            <option value="OM">OMAN</option>
                            <option value="PK">PAKISTAN</option>
                            <option value="PW">PALAU</option>
                            <option value="PS">PALESTINE</option>
                            <option value="PA">PANAMA</option>
                            <option value="PG">PAPUA NEW GUINEA</option>
                            <option value="PY">PARAGUAY</option>
                            <option value="PE">PERU</option>
                            <option value="PH">PHILIPPINES</option>
                            <option value="PN">PITCAIRN</option>
                            <option value="PL">POLAND</option>
                            <option value="PT">PORTUGAL</option>
                            <option value="PR">PUERTO RICO</option>
                            <option value="QA">QATAR</option>
                            <option value="RE">REUNION</option>
                            <option value="RO">ROMANIA</option>
                            <option value="RU">RUSSIAN FEDERATION</option>
                            <option value="RW">RWANDA</option>
                            <option value="BL">SAINT BARTHELEMY</option>
                            <option value="KN">SAINT KITTS AND NEVIS</option>
                            <option value="LC">SAINT LUCIA</option>
                            <option value="MF">SAINT MARTIN (FRENCH)</option>
                            <option value="WS">SAMOA</option>
                            <option value="SM">SAN MARINO</option>
                            <option value="ST">SAO TOME AND PRINCIPE</option>
                            <option value="SA">SAUDI ARABIA</option>
                            <option value="SN">SENEGAL</option>
                            <option value="RS">SERBIA</option>
                            <option value="SC">SEYCHELLES</option>
                            <option value="SL">SIERRA LEONE</option>
                            <option value="SG">SINGAPORE</option>
                            <option value="SX">SINT MAARTEN (DUTCH)</option>
                            <option value="SK">SLOVAKIA</option>
                            <option value="SI">SLOVENIA</option>
                            <option value="SB">SOLOMON ISLANDS</option>
                            <option value="SO">SOMALIA</option>
                            <option value="ZA">SOUTH AFRICA</option>
                            <option value="SS">SOUTH SUDAN</option>
                            <option value="ES">SPAIN</option>
                            <option value="LK">SRI LANKA</option>
                            <option value="SH">ST. HELENA</option>
                            <option value="PM">ST. PIERRE AND MIQUELON</option>
                            <option value="SD">SUDAN</option>
                            <option value="SR">SURINAME</option>
                            <option value="SZ">SWAZILAND</option>
                            <option value="SE">SWEDEN</option>
                            <option value="CH">SWITZERLAND</option>
                            <option value="SY">SYRIAN ARAB REPUBLIC</option>
                            <option value="TW">TAIWAN, PROVINCE OF CHINA</option>
                            <option value="TJ">TAJIKISTAN</option>
                            <option value="TZ">TANZANIA</option>
                            <option value="TH">THAILAND</option>
                            <option value="TL">TIMOR-LESTE</option>
                            <option value="TG">TOGO</option>
                            <option value="TK">TOKELAU</option>
                            <option value="TO">TONGA</option>
                            <option value="TT">TRINIDAD AND TOBAGO</option>
                            <option value="TN">TUNISIA</option>
                            <option value="TR">TURKEY</option>
                            <option value="TM">TURKMENISTAN</option>
                            <option value="TV">TUVALU</option>
                            <option value="UM">U.S. MINOR ISLANDS</option>
                            <option value="UG">UGANDA</option>
                            <option value="UA">UKRAINE</option>
                            <option value="AE">UNITED ARAB EMIRATES</option>
                            <option value="GB">UNITED KINGDOM</option>
                            <option value="US">UNITED STATES</option>
                            <option value="UY">URUGUAY</option>
                            <option value="UZ">UZBEKISTAN</option>
                            <option value="VU">VANUATU</option>
                            <option value="VE">VENEZUELA</option>
                            <option value="VN">VIET NAM</option>
                            <option value="EH">WESTERN SAHARA</option>
                            <option value="YE">YEMEN</option>
                            <option value="ZM">ZAMBIA</option>
                            <option value="ZW">ZIMBABWE </option>
                        </select>
                    </td>
                </tr><tr>
                    <td colspan="4" class="section">Next of Kin</td>
                </tr><tr>
                    <td width="20%"><label>Full Name</label></td><td><input type="text" name="kin-name" id="" class="" maxlength="50" /> </td>
                    <td><label>Phone Number</label></td><td><input type="text" name="kin-fone" id="" class="" maxlength="30" /> </td>
                </tr><tr>
                    <td colspan="4" class="section">Carefully Indicate Your Profession Category</td>
                </tr><tr>
                    <td colspan="4">
                    	<input type="radio" name="prof" value="Sedentary"/>Office Based Works<br />
                    	<input type="radio" name="prof" value="Active "/>Construction/Site Works<br />
                    	<input type="radio" name="prof" value="Very Active"/>Non-Mechanized Agriculturist/Competitive Cyclist/Professional Sport Person<br />
                        <a href="General Physical Activities.php" target="_new"> See List of General Physical Activities.</a>
                    </td>
                </tr><tr>
                    <td colspan="4" class="section">Hold Shift Button To Select List of Favourite/Allergic Foods</td>
                </tr><tr>
                    <td colspan="2">Select Your Favourites Here<br />
                    <select name="Favourite" multiple="multiple" style="height:80px;" onchange="AddOption(this, 'Favourites')">
                    	<?php echo getLoadFoods('Food', "Id, `Food Description`");?><input name="Favourites" id="Favourites" type="hidden"/>
                    </select></td>
                    <td colspan="2">Select Your Favourites Here<br />
                    <select name="Allergic" multiple="multiple" style="height:80px;" onchange="AddOption(this, 'Allergics')">
                    	<?php echo getLoadFoods('Food', "Id, `Food Description`");?><input name="Allergics" id="Allergics" type="hidden"/>
                    </select></td>
                </tr><tr>
                	<td colspan="4"><img src="images/logininfo.png" width="100%" height="40" /></td>
                </tr><tr>
                    <td><label>User Type</label></td><td>
                        <select name="type">
                            <option></option>
                            <option value="Patient">Patient</option>
                            <option value="Deitician">Dietician</option>
                            <option value="Adhoc">Ad Hoc User</option>
                        </select>
                    </td>
                    <td colspan="3"><label>Create Username</label><?php echo spaces(4); ?><input type="text" name="uname" id="" maxlength="15" /> </td>
                </tr><tr>
                    <td><label>Choose Password</label></td><td><input type="password" name="password" id="" class=""  /> </td>
                    <td colspan="3"><label>Confirm Password</label><?php echo spaces(3); ?><input type="password" name="pass" id="" class="" /> </td>
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
<?php
	$emailMsg = "Thanks for Registering With Us";
?>