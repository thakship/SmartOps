<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request Report Selection 
Purpose			: To get Select Service Request Report 
Author			: Madushan Wikramaarachchi
Date & Time		: 09.47 A.M 26/01/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/q/003";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Request Report Selection</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	#outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.min.js"></script>
<script src="jquery/jquery-ui.js"></script>

<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#myTable").btechco_excelexport({
                //alert('Table');
                containerid: "myTable"
               , datatype: $datatype.Table
            });
        });
    });
</script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
    function pageClose(){ //Page Close Function.......
        parent.location.href = parent.location.href;
    }       
    
    function isSelectSRReport(){
        var date1 = document.getElementById('empappodate1').value;
        var date2 = document.getElementById('empappodate2').value;
		var getUgroup = document.getElementById('txtuserG').value;
         var getD = document.getElementById('txtuserD').value;
		var r = 2;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getSRReoptDate1="+date1+"&getSRReoptDate2="+date2+"&getSRUGroup="+getUgroup+"&opt="+r+"&getDe="+getD,true);
        mydata.send();
    }
    function isChangeStates(getValNum,getID){
        var getValID = document.getElementById(getID).value;
        var getUgroup = document.getElementById('txtuserG').value;
        var getD = document.getElementById('txtuserD').value;
		var r = 2;
        var getURL = "../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getSelectSRSelection="+getValID+"&getSelectIDSelection="+getValNum+"&getSelectUGroupSelection="+getUgroup+"&opt="+r+"&getDe="+getD;
        selectData = new XMLHttpRequest();
        selectData.onreadystatechange=function(){
            if(selectData.readyState==4){
                document.getElementById('maneSpan').innerHTML=selectData.responseText;           
            }
        }
        selectData.open("GET",getURL,true);
        selectData.send();
    }
     function gettrVal(id,title,x){
        popup(title,x);
	
    }
     function popup(title,x){
		if(x==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML=mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+title,true);
			mydataGried.send();
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }
   }
   
   function isPrint(){
        //alert('aaaaa');
        var prtContent = document.getElementById("viewsl_gried");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
   }
   function getprintCopy(){
		var prtContent = document.getElementById("viewsl_gried");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
}
</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
     <tr>
        <td style="text-align: right; padding-top:5px; padding-bottom:5; width:100px;">From (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
        </td>
        <td style="text-align:right; padding-top:5px; padding-bottom:5; width:100px;">To (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
            
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	   <input type="button" class='buttonManage' name="getSQLDate" id="getSQLDate" value="Select" onclick="isSelectSRReport()" />
        </td>
      </tr>
</table>
<table>
     <tr>
        <td style="text-align: right; padding-top:5px; padding-bottom:5; width:100px;"></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
            <select class="box_decaretion"  style="width: 130px;" name="sel_States" id="sel_States" onKeyPress="return disableEnterKey(event)" title="1"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeStates(title,this.id)">
                <option value="">--Select States --</option>
            <?php
                $v_sql_States = "SELECT `cmb_code`,`cmb_discr` FROM `cmb_states` WHERE `cmb_state` = 1;";
                $que_getStates = mysqli_query($conn,$v_sql_States);
                while($RES_getStates = mysqli_fetch_array($que_getStates)){
                    echo "<option value=".$RES_getStates[0].">".$RES_getStates[1]."</option>";
                }
            ?>
         </select>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
            <select class="box_decaretion"  style="width: 130px;" name="sel_Urgency" id="sel_Urgency" onKeyPress="return disableEnterKey(event)" title="2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeStates(title,this.id)">
                <option value="">--Select Urgency --</option>
             <?php
                $v_sql_Urgency = "SELECT `ur_code`,`ur_discr` FROM `urgency_states` WHERE `ur_state` = 1;";
                $que_getUrgency = mysqli_query($conn,$v_sql_Urgency);
                while($RES_getUrgency = mysqli_fetch_array($que_getUrgency)){
                    echo "<option value=".$RES_getUrgency[0].">".$RES_getUrgency[1]."</option>";
                }
            ?>
         </select>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
           <select class="box_decaretion"  style="width: 130px;" name="sel_Priority" id="sel_Priority" onKeyPress="return disableEnterKey(event)" title="3" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeStates(title,this.id)">
            <option value="">--Select Priority --</option>
            <?php
                $v_sql_Priority = "SELECT `pr_code`,`pr_discr` FROM `priority_states` WHERE `pr_state` = 1;";
                $que_getPriority = mysqli_query($conn,$v_sql_Priority);
                while($RES_getPriority = mysqli_fetch_array($que_getPriority)){
                    echo "<option value=".$RES_getPriority[0].">".$RES_getPriority[1]."</option>";
                }
            ?>
         </select>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
           <select class="box_decaretion"  style="width: 150px;" name="sel_Source" id="sel_Source" onKeyPress="return disableEnterKey(event)" title="4"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeStates(title,this.id)">
            <option value="">--Select Source of Iss. --</option>
            <?php
                $v_sql_Source = "SELECT `s_type`,`s_descript` FROM `cdb_soarce_of_issue` WHERE `s_stats` = 1;";
                $que_getSource = mysqli_query($conn,$v_sql_Source);
                while($RES_getSource = mysqli_fetch_array($que_getSource)){
                    echo "<option value=".$RES_getSource[0].">".$RES_getSource[1]."</option>";
                }
            ?>
         </select>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
           <select class="box_decaretion"  style="width:150px;" name="sel_User" id="sel_User" onKeyPress="return disableEnterKey(event)" title="5"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeStates(title,this.id)">
            <option value="">--Select Asing User--</option>
            <?php
                $v_sql_userAse = "SELECT `asing_by` 
                                    FROM `cdb_helpdesk` 
                                    WHERE `entry_branch` = '".$_SESSION['userBranch']."' AND `entry_department` = '".$_SESSION['userDepartment']."' 
                                    GROUP BY `asing_by`";
                $que_userAse = mysqli_query($conn,$v_sql_userAse);
                while($RES_userAse = mysqli_fetch_array($que_userAse)){
                    echo "<option value=".$RES_userAse[0].">".$RES_userAse[0]."</option>";
                }
            ?>
            </select>
        </td>
     </tr>
</table>
<br/>
<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<br /><br/>
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA;">
            <th style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></th>
            <th style="width:300px;text-align: left;"><span style="margin-left: 5px;">Issue</span></th>
            <th style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Branch</span></th>
            <th style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Department</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></th>
            <th style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></th>
            <th style="width:80px;text-align: left;"><span style="margin-left: 5px;">Priority</span></th>
            <th style="width:80px;text-align: left;"><span style="margin-left: 5px;">States</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Assign By</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Solved By</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Solved On</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Ackn. By</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Ackn. On</span></th>
        </tr>
        <?php
        $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), replace(`cdb_helpdesk`.`issue`,CHAR(150),'') , `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` ,`cmb_states`.`cmb_discr`, `cdb_helpdesk`.`asing_by`, `cdb_helpdesk`.`solved_by`, DATE(`cdb_helpdesk`.`solved_on`),  `cdb_helpdesk`.`act_by`,  DATE(`cdb_helpdesk`.`act_on`)
                                     FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`
                                     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` 
                                       AND `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` 
                                       AND `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` 
                                       AND `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                       AND  `cdb_helpdesk`.`entry_branch` = '".$_SESSION['userBranch']."'
                                       AND `cdb_helpdesk`.`entry_department` = '".$_SESSION['userDepartment']."'
                                    ORDER BY `cdb_helpdesk`.`helpid`;";
                $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
                $index = 0;
                while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
                    $entryBy = getUserName($rec_det_detels[5],$conn);
                    $asingBy = getUserName($rec_det_detels[9],$conn);
                    $sodBy = getUserName($rec_det_detels[10],$conn);
                    $atcBy = getUserName($rec_det_detels[12],$conn);
                    //$string = str_replace(".","",$rec_det_detels[2]);
                   // $string = preg_replace( '/[^[:print:]]/', '',$rec_det_detels[2]); 
					$string = preg_replace( '/[\x00-\x1F\x80-\xFF]/', '',$rec_det_detels[2]);


                    
                     $index++;
                   echo "<tr id = 'tr".$index."' title = '".$rec_det_detels[0]."' onclick='gettrVal(this.id,title,1)'>";
                    echo "<td style='width:60px;text-align: right;'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
                    echo "<td style='width:300px;text-align: left;'><span style='margin-left: 2px;'>".$string."</span></td>";   /*$rec_det_detels[2]*/
                    echo "<td style='width:150px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
                    echo "<td style='width:150px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' 'title = '".$entryBy."'><span style='margin-right: 2px;'>".$rec_det_detels[5]."</span></td>";
                   echo "<td style='width:100px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[6]."</span></td>";
                    echo "<td style='width:80px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
                    echo "<td style='width:80px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$sodBy."'><span style='margin-right: 2px;'>".$rec_det_detels[10]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[11]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$atcBy."'><span style='margin-right: 2px;'>".$rec_det_detels[12]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[13]."</span></td>";
                    echo "</tr>";
                }
        ?>
</table>
</span>
<div style="display: none;">
<input type="text" name="txtuserG" id="txtuserG" value="<?php echo $_SESSION['userBranch']; ?>"  onKeyPress="return disableEnterKey(event)"/>
<input type="text" name="txtuserD" id="txtuserD" value="<?php echo $_SESSION['userDepartment']; ?>"  onKeyPress="return disableEnterKey(event)"/>

</div>
<?php
function getUserName($userID,$conn){
    $v_sql_getUsreNAme = "SELECT `userID` FROM `user` WHERE `userName` =  '".$userID."';";
    $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
    while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
        return $RES_getUsreNAme[0];
    }
}
?>
<span id="getGried"></span>
</form>
</body>
</html>

