<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="69%" align="center" border="2">
<tr>
<?php include('hang.php'); ?>
    <td valign="top" width="70%">
	    <table width="100%" style="border:1px solid #CCCCCC; border-collapse:collapse" border="1">
            <tr style="padding:0px 0px opx 0px">
                <td width="511" height="350" valign="top">
                	<?php
//						getMsgs($QueryResponse);						
//						getMsgs($_GET);						
					?>
                    <script type="text/javascript">new fadeshow(fadeimages, 620, 350, 0, 3000, 1, "R")</script>
                </td>
            </tr>
        </table>                
	</td><td width="" align="left" valign="top">
        <table width="203" align="right" style="border-collapse:collapse; border-left:dotted 1pt; border-left-color:#CCCCCC">
            <tr>
                <td width="193" height="25" valign="top">
                    <ul id="countrytab" class="shadetabs">
                    <li><a href="studyBackground.php" rel="#iframe" class="selected">Motivation</a></li>
                    <li><a href="objectives.php" rel="#iframe">Aim &amp; Objectives</a></li>
                    <li><a href="methodology.php" rel="#iframe">Methodology</a></li>
                    <li><a href="contributions.php" rel="#iframe">Contributions to Knowledge</a></li>
                    </ul>
                    
                    <div id="countrydivcontainer" style="border:1px  #CCCCCC; width:400px; margin-bottom: 1em; padding:5px"></div>
                    
                    <script type="text/javascript">
                    var countries=new ddajaxtabs("countrytab", "countrydivcontainer")
                    countries.setpersist(true)
                    countries.setselectedClassTarget("link") //"link" or "linkparent"
                    countries.init()
                    </script>                    
                </td>
            </tr><tr>
                <td valign="top"><form id="form1" name="form1" method="post" action="">
                  <label><input type="text" name="SearchBox" id="SearchBox" style="width:240px;background:#69C;color:#FFF;font:bold 11px tahoma" /></label>
                  <label><input name="SearchBtn" type="submit" class="mSHStyle" id="SearchBtn" value="Search" /></label>
                  <br />
                  <label class="mSHStyle"><input type="radio" name="radio" id="SearchWhere" value="SearchWhere" />Search in Application</label>
                  <br />
                  <label class="mSHStyle"><input type="radio" name="radio" id="SearchWhere2" value="SearchWhere" />Search Entire Globe</label>
                  <br />
                </form><br /></td>
              </tr>
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
