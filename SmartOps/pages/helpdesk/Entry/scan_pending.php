<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: kiosk Complited Scan
Purpose			: To viwe Request kiosk list for Service
Author			: Madushan Wikramaarachchi
Date & Time		: 10.45 A.M 11/02/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/013";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo getHelpIDreq1;
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
<title>Courier Day Receive  Report</title>
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
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/scan_pending.php?DispName=Scan%20Pending','conectpage');
}
function pageRef(){
   http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/scan_pending.php?DispName=Scan%20Pending','conectpage');
}

function clientValidate(title,cat_cod){
    var helpAdmin = document.getElementById('txt_helpdeskadmin').value;
    var helpClose = document.getElementById('txt_helpdesk_close').value;
    
        var mydata;
        var getHI = document.getElementById(title).value;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }
        
        mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getHelpIDreq_SP="+getHI+"&gettxt_helpdesk_close_SP="+helpClose,true);
        mydata.send();
    
}
function isAddiImgRequset(title){
    //alert(title);
    var helpID = title;
    var aIType = "K";
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/applicationPendingUpload.php?DispName=Application%20%20Pending%20Upload&helpID='+helpID+'&pendingUploadImgType='+aIType,'conectpage');
}

function flagAsScanned(){
    //alert('a');
    var hI = document.getElementById('txt_help_ID').value;
     var txt_USERMY = document.getElementById('txt_USERMY').value;
     //alert(hI);
     //alert(txt_USERMY);
    var r = confirm('Confirm to proceed ?');
    if (r==true){
        //alert('1');
		$.ajax({ 
			type:'POST', 
			data: {get_HI_Scan : hI , get_user_Scan : txt_USERMY}, 
            url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php',  
            //url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
			success: function(val_retn) { 
			   //document.getElementById('maneSpan').innerHTML = val_retn; ,  get_user_Scan : txt_USERMY 
               //alert('2');
			    //alert("Test : "+val_retn);
               if(val_retn == 'OK'){
                   alert('Updated Scan Prosses.')
                    pageRef();
               }else{
                    alert('Updated Error.')
               }
                //pageCloseDefineLetterTypes();
			}               
		});
        
    }
}
</script>
<script>
var metaChar = false;
function keyEvent(event) {
  var key = event.keyCode || event.which;
    if(key == 120){
        //("Key pressed " + key);
       var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();
       
    }
}


</script>
<style type="text/css">    
            .pg-normal {
                color: black;
                font-weight: normal;
                text-decoration: none;    
                cursor: pointer;    
            }
            .pg-selected {
                color: black;
                font-weight: bold;        
                text-decoration: underline;
                cursor: pointer;
            }
        </style>
        
        <script type="text/javascript" src="paging.js"></script>
        <script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  
   function isSelectSRReport(){
        
        var date1 = document.getElementById('empappodate1').value;
        var userGroup = document.getElementById('txt_USERgROUP').value;
        var FacilityNumber = document.getElementById('txt_FacilityNumber').value;
        //alert(date1);
         mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                //alert('a');
                document.getElementById('getDtl').innerHTML=mydata.responseText; 
                var pager = new Pager('myTable', 50); 
                pager.init(); 
                pager.showPageNav('pager', 'pageNavPosition'); 
                pager.showPage(1);          
            }
        }
        
        mydata.open("GET","ajax_scan_pending.php"+"?getEntryDate="+date1+"&getuserGroup="+userGroup+"&geFacilityNumber="+FacilityNumber,true);
        
        mydata.send();
        
   }
  
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data" > 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
     <tr>
        <td style="text-align: left;width:115px;"><label class="linetop">Entry From (Date) :</label></td>
        <td style="text-align:left;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
            
        </td>
        <td>
        <label class="linetop">Facility Number :</label>
        <input type="text" style="width: 250px;" class="box_decaretion" name="txt_FacilityNumber" id="txt_FacilityNumber" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
        <td>
        <input type="button" style="width: 100px;" class='buttonManage' name="getSQLDate" id="getSQLDate" value="Select" onclick="isSelectSRReport()" />
        </td>
      </tr>
</table>
<span id="maneSpan">

<div id="getDtl">
<?php
    $v_sql_det_detelsCNT = "SELECT COUNT(1) FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
        `cdb_helpdesk`.`cat_code` = '1014' AND
        `cdb_helpdesk`.`isScanned` = 0 AND
        date(`cdb_helpdesk`.`enterDateTime`) >= '2016-02-09' AND
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
       ORDER BY `cdb_helpdesk`.`helpid`;";
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
	echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:120px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:260px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:200px;text-align: left;"><span style="margin-left: 5px;">SSB Type</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>-->
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>
            <td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Facility No</span></td>
            <td style="width:50px;"></td>
        </tr>
<?php
 $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                              DATE(`cdb_helpdesk`.`enterDateTime`), 
                              `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , `cdb_helpdesk`.`asing_by` , `cdb_helpdesk`.`cat_code` , `cdb_helpdesk`.`ssb_facility_amount` , `cdb_helpdesk`.`ssb_type`,`cdb_helpdesk`.`help_discr`,IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,`cdb_helpdesk`.`ssb_app_number`,`cdb_helpdesk`.`facno`,`cdb_helpdesk`.`caloser_dateTime`,DATE(`cdb_helpdesk`.`caloser_dateTime`) = DATE(NOW()) AS is_old
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
       `cdb_helpdesk`.`isScanned` = 0 AND
        date(`cdb_helpdesk`.`enterDateTime`) >= '2016-02-09' AND
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
       ORDER BY `cdb_helpdesk`.`enterDateTime`, `cdb_helpdesk`.`helpid`;";
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
       $sql_count_note = "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$rec_det_detels[0]."';";
          $v_que_count_note = mysqli_query($conn,$sql_count_note);
          while($rec_count_note =  mysqli_fetch_array($v_que_count_note)){
                $f_Col = "#000000";
                if($rec_count_note[0] != 0){
                    $f_Col = "#000000";
                }else{
                    $f_Col = "#000000";
                }  
          }
    
        $entryBy = getUserNameGenaral_Mob_Eml($rec_det_detels[6],$conn);
        $asingBy = getUserNameGenaral_Mob_Eml($rec_det_detels[9],$conn);
        $index++;
        if($rec_det_detels[8]=='Highest'){
            $col = "#000000";
        }else{
            $col = "#000000";
        }
        $MyRow = "";
        // if ($_SESSION['user'] == $rec_det_detels[9]){
        if ($rec_det_detels[18]){
           $MyRow = "background-color:#E6FFFA;";
        }
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]."'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:150px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";
        */
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        /*Rizvi*/        
        echo "<td style='width:40px;text-align: left;'><span style='margin-left: 5px;'>".$rec_det_detels[16]."</span></td>";
        
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
?>
</table>
</div>
<br />
<div id="pageNavPosition" style="margin-left: 20px;"></div>
<script type="text/javascript">
        var pager = new Pager('myTable', 50); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
</script>
</span>
<div style="display: none;">
    <input type="text" name="txt_helpdeskadmin" id="txt_helpdeskadmin" value="<?php echo  $_SESSION['helpdeskadmin']; ?>" />
    <input type="text" name="txt_helpdesk_close" id="txt_helpdesk_close" value="<?php echo  $_SESSION['helpdesk_close']; ?>" />
    <input type="text" name="txt_USERgROUP" id="txt_USERgROUP" value="<?php echo  $_SESSION['usergroupNumber']; ?>" />
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
</div>

<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
</form>
</body>
</html>
