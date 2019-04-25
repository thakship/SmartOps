<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Applicetion Pending Upload - Kios
Purpose			: pplicetion Pending Upload
Author			: Madushan Wikramaarachchi
Date & Time		: 03.40 P.M 10/02/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/012";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo getHelpIDreq1;
	/*if($ass != 1){
		header('Location:../../home.php');
	}*/
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
 
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
    window.open(document.referrer,'conectpage');
	//parent.location.href = parent.location.href;
    //window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetClose.php?DispName=Request%20Manager','conectpage');
}
function pageRef(){
   //http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/LoanApproval/Entry/serviceRequsetClose.php?DispName=Request%20Manager','conectpage');
}

function RemoveImage(ImageIDRef){
    //alert(ImageIDRef);
    var r = confirm('Confirm to remove the image ?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {id : ImageIDRef}, 
			url: 'RemoveImage.php', 
			success: function(returnMessage) { 
			alert(returnMessage);   
            if(returnMessage=="Image removed") 
                pageRef(); 
		} 
		});	
    }else{
		//alert('BBBBB');		
	}    
}
    
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<?php 
    if(!isset($_REQUEST['helpID'])){
        echo "NO";
        header('Location:../../../logout.php');
        
    }else{
        
   
?>
<form action="" method="post" name="schform" enctype="multipart/form-data" > 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="maneSpan">

<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Help ID :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;" name="txt_Help_ID" id="txt_Help_ID" value="<?php echo $_REQUEST['helpID']; ?>" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" readonly="readonly"/>
        <span style="display: none;"><input class="box_decaretion" type="text"  style="width:100px;" name="txt_aIType" id="txt_aIType" value="<?php echo $_REQUEST['pendingUploadImgType']; ?>" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" readonly="readonly"/></span>
        <?php
            $sql_select = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `solved_by`, `solved_on`, `s_type`, `scat_code_3`, `asing_by`, `act_by`, `act_on`, `reOpen`, `ipAddress`, `ssb_type`, `ssb_cycle`, `ssb_facility_amount`, `ssb_app_number`, `ssb_app_entry`, `IsAppValid`, `facno`, `curr_stage`, `assign_to`, `taken_by`, `attachment_namesub`, `isdisbursed`, `disbdate`, `isScanned`, `ScannedDate`, `scannedBy`, `cif` FROM `cdb_helpdesk` WHERE `helpid` = '".$_REQUEST['helpID']."';";
            $que_select = mysqli_query($conn , $sql_select);
            while($rec_select = mysqli_fetch_assoc($que_select)){
                echo "<label class='linetop' style='color: #840000;' id='lbl_Help_ID'>".$rec_select['issue']."</label>";
            }
        ?>
    </td>
  </tr>
   <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Upload File :</label></td>
    <td>
         <input class="buttonManage" type="file" name="fileAttachment" id="fileAttachment" />
    </td>
  </tr>
  <tr style="vertical-align: top;">
    <td style="width: 150px; text-align: right;"><label class="linetop">Remark :</label></td>
    <td>
   	    <textarea class="box_decaretion" rows="3" cols="40" name="textRemark" id="textRemark"></textarea>
    </td>
  </tr>  
</table>
<br />
<table>
  <tr>
    <td style="width: 150px; text-align: right;"></td>
    <td>
        <input type="submit" style="width: 100px;" class="buttonManage" id="btnSave" name="btnSave" value="Save"/>
        <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
    </td>
  </tr>
</table>
<hr />
<table  border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 80px;">
    <tr style="background-color: #BEBABA;">
        <td style="width:25px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
        <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">File Name</span></td>
        <td style="width:150px;text-align: left;"><span  style="margin-left: 5px;">Added on</span></td>
        <td style="width:100px;text-align: left;"><span  style="margin-left: 5px;">Added by</span></td>
        <td style="width:200px;text-align: left;"><span  style="margin-left: 5px;">Remark</span></td>
        <td style="width:150px;text-align: left;"><span  style="margin-left: 5px;">Removed on</span></td>
    </tr>
    <?php
        $sql_select_tbl = "SELECT `up_index`, `file_type`, `help_id`, `ai_serial_number`, `file_name`, `file_path`, `ai_file_name`, `done_by`, `done_on`, `flag`,`removedon`, `remark` FROM `pending_upload_file` WHERE `help_id` = '".$_REQUEST['helpID']."';"; 
        $que_select_tbl = mysqli_query($conn , $sql_select_tbl);
        $i = 1;
        if(mysqli_num_rows($que_select_tbl) == 0){
            echo "<tr>";
            echo "<td style='width:25px; text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>";
            echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
           // echo "<td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "</tr>"; 
        }else{
            
            while($rec_select_tbl = mysqli_fetch_assoc($que_select_tbl)){
                if($rec_select_tbl['flag']==5){
                    echo "<tr style='background: yellow'>";
                    echo "<td style='width:25px; text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>";
                    echo "<td style='width:200px;text-align: left;'><span style='background: yellow'>".$rec_select_tbl['file_name']."</span></td>";
                    echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['done_on']."</span></td>";
                    echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['done_by']."</span></td>";
                    echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['remark']."</span></td>";
                    echo "<td style='width:150px;text-align: center;'>".$rec_select_tbl['removedon']."</td>";
                    echo "</tr>";                        
                }                    
                else{
                    echo "<td style='width:25px; text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>";
                    echo "<td style='width:200px; text-align: left;'><a style='color:#000000;' href='http://cdberp:8080/cdb/uploadHelpdesk/".$rec_select_tbl['ai_file_name']."' target='_blank'><span style='margin-left: 5px;'>".$rec_select_tbl['file_name']."</span></a></td>";
                    echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['done_on']."</span></td>";
                    echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['done_by']."</span></td>";
                    echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['remark']."</span></td>";
                    if($rec_select_tbl['done_by']==$_SESSION['user'])
                        echo "<td style='width:150px;text-align: center;'><img src='../../../img/dele.png' alt='Removess' height='16' width='16' onclick='RemoveImage(".$rec_select_tbl['up_index'].");'></td>";
                    else
                        echo "<td style='width:150px;text-align: center;'>&nbsp;</td>";
                    echo "</tr>";                        
                        //echo "&nbsp;&nbsp;<img src='../../../img/dele.png' alt='Removess' height='16' width='16'></img>";
                }      
                                                  
               // echo "<td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['file_path']."</span></td>";
                
                $i++; 
            }
        }
       
        
    ?>
</table>
<?php
    if(isset($_POST['btnSave']) && $_POST['btnSave'] == "Save"){
        //echo "a";
        mysqli_autocommit($conn,FALSE);
        try{
            $_SESSION['fileAttachment'] = "";
            if($_FILES["fileAttachment"]["name"] != ""){ 
                $temp = explode(".", $_FILES["fileAttachment"]["name"]);
                $extension = end($temp);
                //echo $extension;
                if(($_FILES["fileAttachment"]["size"] < 12000000)){
                   // echo "Size Ok";
                    if($_FILES["fileAttachment"]["error"] > 0){
    				    echo "already exists. File Error.";  
                    }else{
                        $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
        				$add = mysqli_query($conn,$sql);
        				while ($rec = mysqli_fetch_array($add)){
        					$_SESSION['CURRENT_DATE'] = $rec[0];
        				}
                        $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
                        $sqlFunction ="SELECT GetNextSerial('pen_img',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
                        $quary_Function = mysqli_query($conn,$sqlFunction);
                        while ($rec_Function = mysqli_fetch_array($quary_Function)){
                            $batch_num = $rec_Function[0]; 
                        }
                        $TableID = $_POST['txt_Help_ID'].str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
    				   $_SESSION['fileAttachment'] = $TableID.$_FILES["fileAttachment"]["name"];
                        if(file_exists("C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment'])){
                            echo "<script> alert('already exists');script>";
                            //return 3;
                            $_SESSION['fileAttachment']="";
    					
      				   }else{
                            //echo $_SESSION['fileAttachment'];
                            //echo $_FILES["fileAttachment"]["name"]; 
                            move_uploaded_file($_FILES["fileAttachment"]["tmp_name"],"C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment']);
                            
                                                         
                            $sql_insert = "INSERT INTO `pending_upload_file`(`file_type`, `help_id`, `ai_serial_number`, `file_name`, `file_path`, `ai_file_name`, `done_by`, `done_on`, `flag` , `remark`) 
                                                                    VALUES ('".$_POST['txt_aIType']."','".$_POST['txt_Help_ID']."','".$batch_num."','".$_FILES["fileAttachment"]["name"]."','C:/wamp64/www/CDB/uploadHelpdesk/','".$_SESSION['fileAttachment']."','".$_SESSION['user']."',now(),0,'".$_POST['textRemark']."');";
                            $que_inser = mysqli_query($conn ,$sql_insert) or die(mysqli_error($conn));
                            
                            // --- Update the helpdesk stat
                            $sql_update = "UPDATE loan_cdb_helpdesk AS chd SET chd.ssb_type = 'Additional Images Uploaded',chd.lastactivityon = now() WHERE chd.helpid = '".$_POST['txt_Help_ID']."';";
                            $que_sql_update = mysqli_query($conn ,$sql_update) or die(mysqli_error($conn));
                            
                            echo "<script> alert('Uploaded file');pageRef();</script>";
                            
                            
                        }
                    }
                }else{
                   echo "maximum file size. < 10MB >";
                }
            }else{
                echo "File is not Selected.";
            }
            
            
            mysqli_commit($conn); 
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
?>
</span>
</form>
<?php
    }
?>
</body>
</html>
