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
	$_SESSION['page']="hel/q/002";
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
    #outer1{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten1{
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
        var getUser = document.getElementById('txtuser').value;
        var getD = document.getElementById('txtuserD').value;
        var sel_States = document.getElementById('sel_States').value;
        var sel_Urgency = document.getElementById('sel_Urgency').value;
        var sel_Priority = document.getElementById('sel_Priority').value;
        var sel_Source = document.getElementById('sel_Source').value;
        //var sel_User = document.getElementById('sel_User').value;
        //var sel_catCode = document.getElementById('sel_catCode').value;
        
        var cat_m = document.getElementById('sel_catagory').value;
        var cat1 = document.getElementById('sel_scat01').value;
        var cat2 = document.getElementById('sel_scat02').value;
        var cat3 = document.getElementById('sel_scat03').value
        
        var asingUer = document.getElementById('txt_AssignBy').value;
        
       // alert(sel_User);
       if(date1 == ""){
        alert('Missing Entry From (Date)');
       }else if(date2 == ""){
         alert('Missing Entry To (Date)');
       }else{
      	    var r = 1;
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    //alert('a');
                    document.getElementById('maneSpan').innerHTML=mydata.responseText;           
                }
            }
            //mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getSRReoptDate1="+date1+"&getSRReoptDate2="+date2+"&getSRUGroup="+getUgroup+"&opt="+r+"&getDe="+getD+"&getsel_States="+sel_States+"&getsel_Urgency="+sel_Urgency+"&getsel_Priority="+sel_Priority+"&getsel_Source="+sel_Source+"&getsel_User="+sel_User+"&getsel_catCode="+,true);
            mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getSRReoptDate1="+date1+"&getSRReoptDate2="+date2+"&getSRUGroup="+getUgroup+"&opt="+r+"&getDe="+getD+"&getsel_States="+sel_States+"&getsel_Urgency="+sel_Urgency+"&getsel_Priority="+sel_Priority+"&getsel_Source="+sel_Source+"&getcat_m="+cat_m+"&getcat1="+cat1+"&getcat2="+cat2+"&getcat3="+cat3+"&getUser="+getUser+"&getAsingUer="+asingUer,true);
            
            mydata.send();
       }
	
    }
    
    
    function isChangeStates(getValNum,getID){
        var getValID = document.getElementById(getID).value;
        var getUgroup = document.getElementById('txtuserG').value;
        var getD = document.getElementById('txtuserD').value;
        
        
		var r = 1;
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
    
    function getUser(title){
        //alert('A')
        if(title==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML = mydataGried.responseText;  
					document.getElementById('outer1').style.visibility = "visible";
					document.getElementById('conten1').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?isUserLog="+title,true);
			mydataGried.send();
	  }else{
		document.getElementById('outer1').style.visibility = "hidden";
		document.getElementById('conten1').style.visibility = "hidden";
	  }
    }
  	function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_AssignBy').value = id1;
			document.getElementById('getAUser').innerHTML = id2;
	}
   function fileSelect(){
      //alert('B')
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup = document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
  }
    function popup(title,x){
        //alert(title);
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

// Develop Madushan - 2017-11-14

function is_getScat_01(getID,getTitle){
    var getCat = document.getElementById(getID).value;
    var cat1 = document.getElementById('sel_catagory').value;
    var cat2 = document.getElementById('sel_scat01').value;
    var cat3 = document.getElementById('sel_scat02').value;
    if(getTitle == 1){
        var divID = 'diva';
    }
    if(getTitle == 2){
        var divID = 'divb';
        
    }
    if(getTitle == 3){
        var divID = 'divc';
        
    }
    if(getTitle == 4){
        var divID = 'divz';
        
    }
    if(getCat == "" &&  getTitle == 1){
        document.getElementById('sel_scat01').value = "";
        document.getElementById('sel_scat02').value = "";
        document.getElementById('sel_scat03').value = "";
        document.getElementById('sel_scat01').disabled = true; 
        document.getElementById('sel_scat02').disabled = true;
        document.getElementById('sel_scat03').disabled = true; 
    }else if(getCat == "" &&  getTitle == 2){
        document.getElementById('sel_scat02').value = "";
        document.getElementById('sel_scat02').disabled = true;
        document.getElementById('sel_scat03').value = "";
        document.getElementById('sel_scat03').disabled = true; 
    }else if(getCat == "" &&  getTitle == 3){
        document.getElementById('txt_Department').value = "";
        document.getElementById('txt_Department').disabled = true; 
    }else{
        var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById(divID).innerHTML=mydata.responseText;
                if(getTitle == 1){
                   document.getElementById('sel_scat02').value = "";
                   document.getElementById('sel_scat02').disabled = true; 
                    document.getElementById('sel_scat03').value = "";
                   document.getElementById('sel_scat03').disabled = true;
                } 
                if(getTitle == 2){
                    document.getElementById('sel_scat03').value = "";
                   document.getElementById('sel_scat03').disabled = true;
                } 
                if(getTitle == 4){
                    //alert('OK');
                                        
                    var mydatais;
            		mydatais= new XMLHttpRequest();
            		mydatais.onreadystatechange=function(){
            			if(mydatais.readyState==4){
            				document.getElementById('get_issue').innerHTML=mydatais.responseText;
            			}
            		}
            		mydatais.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getIss_templet="+getCat+"&get_status="+getTitle+"&getcatCodeSelect="+cat1,true);
            		mydatais.send();
                    
                }           
                     
            }
        }
        mydata.open("GET","ajax_serviceRequset_01.php"+"?txt1="+getCat+"&txt2="+getTitle,true);
        mydata.send();
    }
    
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
    <td style="width: 100px; text-align: right;"><label class="linetop">&nbsp;</label></td>
    <td>
         <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_catagory" id="sel_catagory" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="1" onchange="is_getScat_01(this.id,title);">
            <option value="">--Select Catagory --</option>
            <?php
                $v_sql_getCategory = "SELECT h.cat_code , c.cat_discr 
                                      FROM cat_states AS c , cdb_help_user_oth AS h
                                      WHERE c.car_state = '1' AND 
                                             c.isDisplay = 1 AND
                                              c.cat_code !='1014' AND
                                              c.cat_code = h.cat_code AND
                                              h.user_group = '".$_SESSION['usergroupNumber']."';";
                $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                    echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                }
            ?>
         </select>
    </td>
    <td>
        <div id="diva">
             <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_scat01" id="sel_scat01" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 1--</option>
             </select>
         </div>
    </td>
    <td>
        <div id="divb">
             <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_scat02" id="sel_scat02" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 2--</option>
             </select>
        </div>
    </td>
    <td>
        <div id="divz">
             <select class="box_decaretion"  style="width: 200px;" name="sel_scat03" id="sel_scat03" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 3--</option>
             </select>
        </div>
    </td>
  </tr>
</table>
<table>
     <tr>
       <td style="width: 100px; text-align: right;"><label class="linetop">&nbsp;</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
            <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_States" id="sel_States" onkeypress="return disableEnterKey(event)" title="1"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
            <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_Urgency" id="sel_Urgency" onkeypress="return disableEnterKey(event)" title="2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
           <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_Priority" id="sel_Priority" onkeypress="return disableEnterKey(event)" title="3" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
           <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_Source" id="sel_Source" onkeypress="return disableEnterKey(event)" title="4"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
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
     </tr>
</table><br />
<table>
     <tr>
        <td style="text-align: right;width:115px;"><label class="linetop">Assign By :</label></td>
        <td style="text-align:left;">
        	<input type="text" class="box_decaretion" name="txt_AssignBy" id="txt_AssignBy" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" title="1" onclick="getUser(title);"/>
            <span id="getAUser"></span>
        </td>
      </tr>
</table>
<table>
     <tr>
        <td style="text-align: left;width:115px;"><label class="linetop">Entry From (Date) :</label></td>
        <td style="text-align:left;width:100px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
        <td style="text-align:right; width:100px;"><label class="linetop">Entry To (Date) :</label></td>
        <td style="text-align:left;width:100px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
      </tr>
</table>
<br/>
<div style="margin-left: 100px;">
<input type="button" style="width: 100px;" class='buttonManage' name="getSQLDate" id="getSQLDate" value="Select" onclick="isSelectSRReport()" />
<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</div>
<hr />
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA;">
            <th style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></th>
            <th style="width:300px;text-align: left;"><span style="margin-left: 5px;">Issue</span></th>
            <th style="width:100px;text-align: left;"><span style="margin-left: 5px;">Category 2</span></th>
            <th style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Branch</span></th>
            <th style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Department</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></th>
            <th style="width:80px;text-align: left;"><span style="margin-left: 5px;">States</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Assign By</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Solved By</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Solved On</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Ackn. By</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Ackn. On</span></th>
            <th style="width:80px;text-align: right;"><span style="margin-right: 5px;">Decision</span></th>
        </tr>
        <tr>
            <th style="width:60px;text-align: right;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
            <th style="width:300px;text-align: left;">&nbsp;</th>
             <th style="width:300px;text-align: left;">&nbsp;</th>
            <th style="width:150px;text-align: left;">&nbsp;</th>
            <th style="width:150px;text-align: left;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
            <th style="width:80px;text-align: left;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
            <th style="width:80px;text-align: right;">&nbsp;</th>
        </tr>
</table>
</span>
<div style="display: none;">
<input type="text" name="txtuserG" id="txtuserG" value="<?php echo $_SESSION['usergroupNumber']; ?>"  onKeyPress="return disableEnterKey(event)"/>
<input type="text" name="txtuserD" id="txtuserD" value="<?php echo $_SESSION['userDepartment']; ?>"  onKeyPress="return disableEnterKey(event)"/>
<input type="text" name="txtuser" id="txtuser" value="<?php echo $_SESSION['user']; ?>"  onKeyPress="return disableEnterKey(event)"/>

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

