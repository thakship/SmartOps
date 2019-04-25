<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: DDPO Printing for Union Bank - Spec
Purpose			: Request for CBL exceeding 05 Years Letter
Author			: Madushan Wickramaarachchi
Date & Time		: 02:14 P.M 2018-08-23
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/012";
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
    include('../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Letter Generation</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
    <link rel="stylesheet" href="jquery/jquery-ui.css" />
<style type="text/css">
	
    
</style>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="sp1" style="display:none"><img src="../../../img/loading.gif" /></span>
<table>
     <tr>
            <td style="width: 150px; text-align: right;"><label class="linetop">Process Date :</label></td>
            <td>
            	 <input class="box_decaretion" style="width: 100px;"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"/>
            </td>
     </tr>
</table>
<br /><br />
<div style="margin-left: 100px;">
     <input class="buttonManage" style="width: 100px;" type="button" name="btnProcess" id="btnProcess" value="Process" onclick="getDDPODateProsses();"/>
     <input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
<div id="loadTable"></div>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<div style="display: none;">
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
</div>
</form>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    $(function() {
        $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    
    function getDDPODateProsses(){
        //alert('A');
        var getDate = document.getElementById('empappodate1').value;
        if(getDate == ""){
            alert('Missing Process Date');
        }else{
            var month = new Array();
            month[0] = "JAN";
            month[1] = "FEB";
            month[2] = "MAR";
            month[3] = "APR";
            month[4] = "MAY";
            month[5] = "JUN";
            month[6] = "JUL";
            month[7] = "AUG";
            month[8] = "SEP";
            month[9] = "OCT";
            month[10] = "NOV";
            month[11] = "DEC";
            
            var d = new Date(getDate);
            var requestDate = d.getDate()+'-'+month[d.getMonth()]+'-'+d.getFullYear();
            //alert(requestDate);
            document.getElementById("sp1").style.display = "inline";
           	var mydata;
    		mydata = new XMLHttpRequest();
    		mydata.onreadystatechange=function(){
    			if(mydata.readyState==4){
    				document.getElementById('loadTable').innerHTML = mydata.responseText;
                    document.getElementById("sp1").style.display = "none";
    			}
    		}
    		mydata.open('GET','../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php'+'?isrequestDate_DDPO='+requestDate,true);
    		mydata.send();
        }
        
    }
    
    function isPrint(title){
        var logUser = document.getElementById('txt_USERMY').value;
       // alert(title);
        res = title.split("|");
        //alert(res[0]);
        //alert(res[1]);
        //alert(res[2]);
        var r = confirm('Are you sure you want to Approve this?')
        if (r==true){
            $.ajax({ 
            	type:'POST', 
            	data: {isloguserCBL : logUser , isV_JOB_DATE : res[0], isV_LOAD_JOB : res[1], isV_PRINT_JOB : res[2]}, 
            	url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php', 
            	success: function(val_retn) { 
            	    //alert(val_retn);
                    document.getElementById('sp_load_link_main').innerHTML = val_retn;
                    //pageRef();
                    
                    var getDate = document.getElementById('empappodate1').value;
                    if(getDate == ""){
                        alert('Missing Process Date');
                    }else{
                        var month = new Array();
                        month[0] = "JAN";
                        month[1] = "FEB";
                        month[2] = "MAR";
                        month[3] = "APR";
                        month[4] = "MAY";
                        month[5] = "JUN";
                        month[6] = "JUL";
                        month[7] = "AUG";
                        month[8] = "SEP";
                        month[9] = "OCT";
                        month[10] = "NOV";
                        month[11] = "DEC";
                        
                        var d = new Date(getDate);
                        var requestDate = d.getDate()+'-'+month[d.getMonth()]+'-'+d.getFullYear();
                        //alert(requestDate);
                        document.getElementById("sp1").style.display = "inline";
                       	var mydata;
                		mydata = new XMLHttpRequest();
                		mydata.onreadystatechange=function(){
                			if(mydata.readyState==4){
                				document.getElementById('perited_head').innerHTML = mydata.responseText;
                                document.getElementById("sp1").style.display = "none";
                			}
                		}
                		mydata.open('GET','../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php'+'?isrequestDate_DDPO_Printted='+requestDate,true);
                		mydata.send();
                    }
                      
            	}
            });
        }
    }
    
    function isPrintCancel(title){
         var logUser = document.getElementById('txt_USERMY').value;
       // alert(title);
        res = title.split("|");
        //alert(res[0]);
        //alert(res[1]);
        //alert(res[2]);
        var r = confirm('Are you sure you want to Re-Print this?')
       
        if (r==true){
            document.getElementById("sp1").style.display = "inline";
            $.ajax({ 
            	type:'POST', 
            	data: {isloguserRP : logUser , isV_JOB_DATERP : res[0], isV_LOAD_JOBRP : res[1], isV_PRINT_JOBRP : res[2]}, 
            	url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php', 
            	success: function(val_retn) { 
            	    //alert(val_retn);
                    document.getElementById('loadTable').innerHTML = val_retn;
                    document.getElementById("sp1").style.display = "none";
                    //pageRef();       
            	}
            });
        }
    }
</script>
</body>
</html>