<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Operation
Page Name		: Applicetion Pending Upload - Kios
Purpose			: Aplicetion Pending Upload
Author			: Madushan Wikramaarachchi
Date & Time		: 12.40 P.M 27/01/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ope/e/003";
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
    include('../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Applicetion Pending Upload - Kios</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../Operation_DEVELOPMENT/CSS/operation_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../Operation_DEVELOPMENT/JAVASCRIPT_FUNCTION/operation_js_function"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
    window.open(document.referrer,'conectpage');
	//parent.location.href = parent.location.href;
    //window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetClose.php?DispName=Request%20Manager','conectpage');
}
function pageRef(){
   //http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetClose.php?DispName=Request%20Manager','conectpage');
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
                pageClose(); 
		} 
		});	
    }else{
		//alert('BBBBB');		
	}    
}

function getNewFiledScat02(){
    var sel_Purpose = document.getElementById('sel_Purpose').value;
    
    if(sel_Purpose == 'Insurance Doc'){
        //alert(sel_Purpose);
        document.getElementById('trScat02').style.display = "block";
        document.getElementById('trSecDocU').style.display = "none";
        document.getElementById('sel_Select_Category_02').value = "";
    }else if(sel_Purpose == 'Payment Release Doc'){
       // alert(sel_Purpose);
         document.getElementById('trSecDocU').style.display = "block";
         document.getElementById('trScat02').style.display = "none";
         document.getElementById('sel_Payment_Handling').value = "";
       
    }else{
        document.getElementById('trScat02').style.display = "none";
        document.getElementById('trSecDocU').style.display = "none";
        document.getElementById('sel_Payment_Handling').value = "";
        document.getElementById('sel_Select_Category_02').value = "";
        
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
  <tr style="vertical-align: top;">
    <td style="width: 150px; text-align: right;"><label class="linetop">Purpose :</label></td>
    <td>
   	     <select class="box_decaretion"  style="width: 200px;" name="sel_Purpose" id="sel_Purpose" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getNewFiledScat02();">
                <option value="">--Select Purpose--</option>
                <option value="Pending Reply"> Pending Reply </option>
                <option value="Insurance Doc"> Insurance Doc </option>
                <option value="Security Doc"> Security Doc</option>
                <option value="Payment Release Doc"> Payment Release Doc</option>
         </select>
    </td>
  </tr>
</table>
<table id="trScat02" style="display: none;">
  <tr style="vertical-align: top;">
    <td style="width: 150px; text-align: right;"><label class="linetop">Select Category 02  :</label></td>
    <td>
   	     <select class="box_decaretion"  style="width: 200px;" name="sel_Select_Category_02" id="sel_Select_Category_02" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                <option value="">--Select Category--</option>
                <?php
                    $sql_scat02 = "SELECT s2.scat_code_2 , s2.scat_discr_2 FROM scat_02 AS s2 WHERE s2.scat_code_1 = '100301';";
                   // $query_scat02 = mysqli_query($conn, $sql_scat02) or die(mysqli_error($conn));
                   $query_scat02 = mysqli_query($conn ,$sql_scat02);
                   while($rec_scat02 = mysqli_fetch_assoc($query_scat02)){
                        echo "<option value='".$rec_scat02['scat_code_2']."'>".$rec_scat02['scat_discr_2']."</option>";
                    }
                ?>
                
               
         </select>
    </td>
  </tr>
</table>
<table id="trSecDocU" style="display: none;">
  <tr style="vertical-align: top;">
    <td style="width: 150px; text-align: right;"><label class="linetop">Customer Status  :</label></td>
    <td>
   	     <select class="box_decaretion"  style="width: 200px;" name="sel_Payment_Handling" id="sel_Payment_Handling" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                <option value="New Customer"> New Customer</option>
                <option value="Existing Customer"> Existing Customer</option>    
         </select>
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
        <td style="width:200px;text-align: left;"><span  style="margin-left: 5px;">Purpose</span></td>
        <td style="width:200px;text-align: left;"><span  style="margin-left: 5px;">Customer Status</span></td>
        <td style="width:150px;text-align: left;"><span  style="margin-left: 5px;">Removed on</span></td>
    </tr>
    <?php
        $sql_select_tbl = "SELECT `up_index`, `file_type`, `help_id`, `ai_serial_number`, `file_name`, `file_path`, `ai_file_name`, `done_by`, `done_on`, `flag`,`removedon`, `remark` , `DocPurpose` , `PaymentHandling` FROM `pending_upload_file` WHERE `help_id` = '".$_REQUEST['helpID']."';"; 
        $que_select_tbl = mysqli_query($conn , $sql_select_tbl);
        $i = 1;
        if(mysqli_num_rows($que_select_tbl) == 0){
            echo "<tr>";
            echo "<td style='width:25px; text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>";
            echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
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
                    echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['DocPurpose']."</span></td>";
                    echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['PaymentHandling']."</span></td>";
                    echo "<td style='width:150px;text-align: center;'>".$rec_select_tbl['removedon']."</td>";
                    echo "</tr>";                        
                }                    
                else{
                    echo "<td style='width:25px; text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>";
                    echo "<td style='width:200px; text-align: left;'><a style='color:#000000;' href='http://cdberp:8080/cdb/uploadHelpdesk/".$rec_select_tbl['ai_file_name']."' target='_blank'><span style='margin-left: 5px;'>".$rec_select_tbl['file_name']."</span></a></td>";
                    echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['done_on']."</span></td>";
                    echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['done_by']."</span></td>";
                    echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['remark']."</span></td>";
                    echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['DocPurpose']."</span></td>";
                     echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_tbl['PaymentHandling']."</span></td>";
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
        echo "a";
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
                            //
                                                         
                            $sql_insert = "INSERT INTO `pending_upload_file`(`file_type`, `help_id`, `ai_serial_number`, `file_name`, `file_path`, `ai_file_name`, `done_by`, `done_on`, `flag` , `remark` ,`DocPurpose`,`scat02` , `PaymentHandling`)   
                                                                    VALUES ('".$_POST['txt_aIType']."','".$_POST['txt_Help_ID']."','".$batch_num."','".$_FILES["fileAttachment"]["name"]."','C:/wamp64/www/CDB/uploadHelpdesk/','".$_SESSION['fileAttachment']."','".$_SESSION['user']."',now(),0,'".$_POST['textRemark']."','".$_POST['sel_Purpose']."','".$_POST['sel_Select_Category_02']."','".$_POST['sel_Payment_Handling']."');";
                            $que_inser = mysqli_query($conn ,$sql_insert) or die(mysqli_error($conn));
                            
                            // --- Update the helpdesk stat
                            
                            
                            if($_POST['sel_Purpose'] != ""){
                                if($_POST['sel_Purpose'] == "Security Doc"){
                                    $sql_p = "UPDATE cdb_helpdesk AS h SET h.QC_SECDOCS_DATA = NOW() WHERE h.helpid = '".$_POST['txt_Help_ID']."';";
                                    $query_p = mysqli_query($conn,$sql_p) or die(mysqli_error($conn));
                                }else if($_POST['sel_Purpose'] == "Insurance Doc"){
                                    $sql_p = "UPDATE cdb_helpdesk AS h SET h.QC_INS_ON_DATA = NOW() WHERE h.helpid = '".$_POST['txt_Help_ID']."';";
                                    $query_p = mysqli_query($conn,$sql_p) or die(mysqli_error($conn));
                                }
                                // START :: Update on 1:04 PM 30/11/2017 Madushan (Yasika wanted this)
                                else if($_POST['sel_Purpose'] == "Pending Reply"){
                                    $sql_update = "UPDATE cdb_helpdesk AS chd SET chd.ssb_type = 'Additional Images Uploaded',chd.lastactivityon = now() WHERE chd.helpid = '".$_POST['txt_Help_ID']."';";
                                    $que_sql_update = mysqli_query($conn ,$sql_update) or die(mysqli_error($conn));
                                } // END :: Update on 1:04 PM 30/11/2017 Madushan (Yasika wanted this)
                                else{
                            
                                }
                                
                            }
                            //------------------------- Madushan - 2018-01-17 -----------
                            $sql_getEmail= "SELECT u.email , s.facno 
                                            FROM cdb_helpdesk AS s , user AS u
                                            WHERE s.helpid = '".$_POST['txt_Help_ID']."'  AND
                                                  s.COD_FILE_PROCUSER = u.userName;";
                            $query_getEmail = mysqli_query($conn,$sql_getEmail);
                            while($rec_get_email = mysqli_fetch_array($query_getEmail)){
                                if($rec_get_email[0] != ""){
                        

                                    $to = $rec_get_email[0];
                                    $subject = "Operation : Pending Reply!";
                                
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Service Request ID</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$_POST['txt_Help_ID']."</td>
    </tr>
    	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Facility No :</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$rec_get_email[1]."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Remark</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$_POST['textRemark']."</td>
    </tr>
 </table>

</body>
</html>";
                                /*$headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                		
                                						// More headers
                                $headers .= "From: <cdberp@cdbnet.lk>" . "\r\n";*/
                                //$to_cc = "wimukthi.madushan@cdb.lk";
                                $to_cc = "";
                               // mail($to,$subject,$message,$headers);
                               /* if (mail($to,$subject,$message,$headers))
                                {
                                    echo "Message accepted";
                                }
                                else
                                {
                                    echo "Error: Message not accepted";
                                }*/
                                $message_body = mysqli_real_escape_string($conn,$message);
                                $inseet_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) 
                                                                    VALUES (NOW(), 'SYSTEM', '".$to."', '".$subject."', '".$message_body."', '".$to_cc."', '0000-00-00 00:00:00');";
                                //echo $inseet_mailBox;
                                $que_mailBox = mysqli_query($conn,$inseet_mailBox) or die(mysqli_error($conn));
                                
                     }
                                
                            }
                            
             
                            
                            //--------------------------------------------------
                            
                            echo "<script> alert('Uploaded file');pageClose();</script>";
                            
                            
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
